<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\auther;
use App\Models\category;
use App\Models\publisher;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorebookRequest;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatebookRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Dompdf\Dompdf;
use Dompdf\Options;
use DNS2D;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
// app/Http/Controllers/BookController.php

    public function downloadQrCode($id)
    {
        $book = Book::findOrFail($id);
        $redirectUrl = route('librarian.detail', ['id' => $book->id]);
        $qrCodeHtml = DNS2D::getBarcodeHTML($redirectUrl, 'QRCODE', 6, 6); // Adjust size here as well

        // Setup DomPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // Generate the PDF content
        $html = '
        <html>
            <head>
                <style>
                    .qr-code-container {
                        text-align: center;
                        margin-top: 20px;
                    }
                    .qr-code-container img {
                        width: 300px;  /* Adjust size for PDF */
                        height: 300px;
                    }
                </style>
            </head>
            <body>
                <h1>QR Code for ' . $book->name . '</h1>
                <div class="qr-code-container">
                    ' . $qrCodeHtml . ' <!-- Display QR Code -->
                </div>
            </body>
        </html>';

        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('qr_code_' . $book->id . '.pdf');
    }


    // Controller
    public function getBookDetails($id)
    {
        $book = Book::with(['category', 'auther', 'publisher'])->find($id);

        if ($book) {
            // Render the Blade view and pass the $book to it
            return view('librarian/book/book_detail', compact('book'));
        }

        return response()->json(['message' => 'Book not found'], 404);
    }

    public function show1($id)
    {
        $book = Book::findOrFail($id);
        return view('partials.book-detail', compact('book'));  // or return json if you prefer
    }

    public function indexg()
    {
        $books = Book::with(['auther', 'category', 'publisher'])->paginate(6);  // Eager load relationships
        $categories = Category::all();

        return view('dashboard', [
            'books' => $books->appends(request()->query()),  // Mempertahankan query string saat melakukan pagination
            'categories' => $categories
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        // Filter buku berdasarkan nama atau nama penulis
        $books = Book::with(['auther', 'category', 'publisher']) // Eager load relationships
            ->where('name', 'LIKE', '%' . $query . '%')
            ->orWhereHas('auther', function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%');
            })
            ->paginate(6);

        // Tambahkan appends untuk mempertahankan query string saat melakukan pagination
        return view('dashboard', [
            'books' => $books->appends(request()->query()),
            'query' => $query, // Untuk menampilkan kembali kata pencarian di view
        ]);
    }

    public function index(Request $request)
    {
        // Ambil query pencarian
        $search = $request->input('search');

        $books = Book::with('category', 'auther', 'publisher')  // Join dengan relasi yang diperlukan
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%') // Pencarian berdasarkan nama buku
                    ->orWhereHas('auther', function($query) use ($search) {
                        return $query->where('name', 'like', '%' . $search . '%'); // Pencarian berdasarkan nama penulis
                    });
            })
            ->paginate(6);

            return view('librarian.book.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::with(['category', 'auther', 'publisher'])->findOrFail($id);

        return response()->json([
            'id' => $book->id,
            'name' => $book->name,
            'category' => ['name' => $book->category->name],
            'auther' => ['name' => $book->auther->name],
            'publisher' => ['name' => $book->publisher->name],
            'cover_image' => $book->cover_image ? asset($book->cover_image) : null,
            'product_code' => $book->product_code,
            'qr_code' => $book->product_code ? DNS2D::getBarcodeHTML(route('librarian.detail', ['id' => $book->id]), 'QRCODE') : null,
        ]);
    }

     /**
      * Show the form for creating a new resource.
      */
      public function create()
      {
          $authors = Auther::latest()->get();
          $publishers = Publisher::latest()->get();
          $categories = Category::latest()->get();
      
          return view('librarian.book.create', compact('authors', 'publishers', 'categories'));
      }
 
     /**
      * Store a newly created resource in storage.
      */
     public function store(StoreBookRequest $request)
     {
         $number = mt_rand(10000000,99999999);

         if ($this->productCodeExists($number)) {
            $number = mt_rand(10000000,99999999);
         }
         // Initialize the book data array with the validated request data
         $bookData = $request->validated() + [
            'product_code' => $number,
            'status' => 'Y',
            'sinopsis' => $request->input('sinopsis')];
 
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
    
            // List MIME Type gambar yang diperbolehkan
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
    
            // **Pengecekan tambahan: Jika bukan gambar, kembalikan error**
            if (!in_array($image->getMimeType(), $allowedMimeTypes)) {
                return redirect()->back()->withErrors(['cover_image' => 'File yang diupload harus berupa gambar asli (JPG, JPEG, PNG, atau GIF).']);
            }
    
            // Simpan cover baru
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $bookData['cover_image'] = 'images/' . $imageName;
        }
 
         // Create the book with the data
         Book::create($bookData);
 
         return redirect()->route('librarian.books')->with('success', 'Book added successfully.');
     }

     public function productCodeExists($number) {
        return Book::whereProductCode($number)->exists();
     }
 
     /**
      * Show the form for editing the specified resource.
      */
     public function edit(Book $book)
     {
         return view('librarian.book.edit', [
             'authors' => Auther::latest()->get(),
             'publishers' => Publisher::latest()->get(),
             'categories' => Category::latest()->get(),
             'book' => $book
         ]);
     }
 
     /**
      * Update the specified resource in storage.
      */
      public function update(UpdateBookRequest $request, $id)
      {
          // Cari data book berdasarkan ID atau kembalikan 404 jika tidak ditemukan
        $book = Book::findOrFail($id);

        // Update field book dari request
        $book->name = $request->input('name');
        $book->auther_id = $request->input('author_id'); // Perbaiki typo jika ada
        $book->category_id = $request->input('category_id');
        $book->publisher_id = $request->input('publisher_id');
        $book->sinopsis = $request->input('sinopsis');

        // Jika ada cover_image baru, hapus gambar lama dan upload gambar baru
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
    
            // List MIME Type gambar yang diperbolehkan
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
    
            // **Pengecekan tambahan: Jika bukan gambar, kembalikan error**
            if (!in_array($image->getMimeType(), $allowedMimeTypes)) {
                return redirect()->back()->withErrors(['cover_image' => 'File yang diupload harus berupa gambar asli (JPG, JPEG, PNG, atau GIF).']);
            }
    
            // Hapus cover image lama jika ada
            if ($book->cover_image && file_exists(public_path($book->cover_image))) {
                unlink(public_path($book->cover_image));
            }
    
            // Simpan cover baru
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $book->cover_image = 'images/' . $imageName;
        }    
        // Simpan perubahan ke database
        $book->save();

        // Redirect dengan pesan sukses
        return redirect()->route('librarian.books')->with('success', 'Book updated successfully.');
      }
      
 
     /**
      * Remove the specified resource from storage.
      */
      public function destroy(Book $book)
    {
        if ($book->status !== 'Y') {
            return back()->with('error', 'Buku sedang dipinjam, tidak bisa dihapus.');
        }

        $book->delete();
        return redirect()->route('librarian.books')->with('success', 'Buku berhasil dihapus.');
    }
    
 }
 

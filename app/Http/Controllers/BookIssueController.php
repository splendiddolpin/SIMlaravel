<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\book;
use App\Models\auther;
use App\Models\history;
use App\Models\student;
use App\Models\settings;
use App\Models\User;
use App\Models\book_issue;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Storebook_issueRequest;
use App\Http\Requests\Updatebook_issueRequest;

class BookIssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('librarian.book.issueBooks', [
            'books' => book_issue::with('user', 'book')->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('librarian.book.issueBook_add', [
            'students' => User::latest()->get(),
            'books' => book::where('status', 'Y')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storebook_issueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storebook_issueRequest $request)
    {
        $issue_date = date('Y-m-d');
        $return_date = date('Y-m-d', strtotime("+" . (settings::latest()->first()->return_days) . " days"));

        // Ambil data user berdasarkan student_id
        $user = User::find($request->student_id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Ambil data buku berdasarkan book_id
        $book = Book::find($request->book_id);
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found.');
        }

        // Buat entri di tabel book_issue
        $data = book_issue::create([
            'user_id' => $request->student_id,
            'book_id' => $request->book_id,
            'issue_date' => $issue_date,
            'return_date' => $return_date,
            'issue_status' => 'N',
        ]);
        $data->save();

        // Perbarui status buku
        $book->status = 'N';
        $book->save();

        return redirect()->route('librarian.book_issued')->with('success', 'Book issue added successfully.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Ambil data peminjaman
        $book_issue = book_issue::find($id);
        if (!$book_issue) {
            return redirect()->back()->with('error', 'Book issue not found.');
        }

        $book = Book::find($book_issue->book_id);
        $user = User::find($book_issue->user_id);
        $return_days = settings::latest()->first()->return_days;
        
        // Hitung denda (jika ada)
        $first_date = date_create(date('Y-m-d'));
        $last_date = date_create($book_issue->return_date);
        $diff = date_diff($first_date, $last_date);
        $fine = (settings::latest()->first()->fine * $diff->format('%a'));

        // Hanya menampilkan data tanpa memanipulasi status atau history
        return view('librarian.book.issueBook_edit', [
            'book' => $book_issue,
            'fine' => $fine,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatebook_issueRequest  $request
     * @param  \App\Models\book_issue  $book_issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the book issue record
        $book_issue = book_issue::find($id);
        if (!$book_issue) {
            return redirect()->back()->with('error', 'Book issue not found.');
        }

        // Retrieve book and user data
        $book = Book::find($book_issue->book_id);
        $user = User::find($book_issue->user_id);
        $return_days = settings::latest()->first()->return_days;
        $denda = \App\Models\Settings::first()->denda ?? 0;

        // Buat entri history setelah buku dikembalikan
        history::create([
            'student_name' => $user->name,
            'book_name' => $book->name,
            'issue_date' => $book_issue->issue_date,
            'return_date' => date('Y-m-d'), // Set return date ke hari ini
            'issue_status' => 'Y',
            'return_day' => $return_days, // Tambahkan return_days ke history
            'denda' => $denda,
        ]);

        // Update the issue status to 'Y' (Returned) and set the return day
        $book_issue->issue_status = 'Y';
        $book_issue->return_day = now();
        $book_issue->save();

        // Update the status of the book to 'Y' (Available)
        $book->status = 'Y';
        $book->save();

        // Delete the book issue record after updating
        $book_issue->delete();

        // Redirect to the book issued page with a success message
        return redirect()->route('librarian.book_issued')->with('success', 'Book issue updated and deleted successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\book_issue  $book_issue
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan record book_issue yang akan dihapus
        $book_issue = book_issue::find($id);

        // Pastikan record book_issue ditemukan
        if (!$book_issue) {
            return redirect()->route('librarian.book_issued')->with('error', 'Book issue not found.');
        }

        // Temukan buku terkait
        $book = Book::find($book_issue->book_id);

        // Jika buku ditemukan, update statusnya menjadi 'Y' (Tersedia)
        if ($book) {
            $book->status = 'Y';  // Mengubah status buku menjadi 'Y'
            $book->save();  // Simpan perubahan status buku
        }

        // Hapus data book_issue
        $book_issue->delete();

        // Redirect ke halaman book_issued dengan pesan sukses
        return redirect()->route('librarian.book_issued')->with('success', 'Book issue deleted successfully.');
    }   


    public function rent(Request $request)
    {
        // Validasi input
        $issue_date = date('Y-m-d');
        $settings = Settings::latest()->first();
        if (!$settings) {
            return redirect()->back()->with('error', 'Return days setting not found.');
        }
        $return_date = date('Y-m-d', strtotime("+" . $settings->return_days . " days"));

        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        // Ambil data buku berdasarkan book_id
        $book = Book::find($request->book_id);
        if ($book->status !== 'Y') {
            return redirect()->back()->with('error', 'The book is currently unavailable for rent.');
        }

        // Ambil data user yang sedang login
        $user = auth()->user();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

    // Tambahkan data ke tabel book_issue
    $data = book_issue::create([
        'book_id' => $request->book_id,
        'issue_date' => $issue_date,
        'return_date' => $return_date,
        'issue_status' => 'N',
        'user_id' => auth()->id(),
    ]);
    $data->save();

    // Update status buku menjadi tidak tersedia
    Book::where('id', $request->book_id)->update(['status' => 'N']);

    return redirect()->route('student.dashboard')->with('success', 'Book issued successfully!');
}


public function status()
{
    $userId = auth()->id();

    // Ambil data denda dari settings table
    $settings = Settings::first();  
    $dendaRate = $settings->denda;
    $returndays = $settings->return_days;

    // Ambil data book_issue dengan relasi book
    $bookIssues = book_issue::with('book')
        ->where('user_id', $userId)
        ->get()
        ->map(function ($issue) use ($dendaRate) {
            $today = Carbon::today(); 
            $returnDate = Carbon::parse($issue->return_date)->startOfDay();

            if ($today->greaterThan($returnDate) && $issue->issue_status === 'N') {
                // Hitung jumlah hari keterlambatan
                $issue->late_days = $today->diffInDays($returnDate); // ✅ Tambahkan late_days ke object
                $issue->calculated_penalty = $dendaRate * $issue->late_days; 
            } else {
                $issue->late_days = 0;
                $issue->calculated_penalty = 0;
            }

            return $issue;
        });

    return view('status', compact('bookIssues', 'dendaRate', 'returndays'));
}

}

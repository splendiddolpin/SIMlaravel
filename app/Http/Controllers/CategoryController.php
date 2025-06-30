<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // Jika ada parameter pencarian
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Ambil kategori dengan paginasi 5 per halaman
        $categories = $query->paginate(5);

        return view('librarian.category.index', [
            'categories' => $categories
        ]);
    }
    
    public function search_category()
    {
        // Ambil semua data kategori
        $categories = category::all();

        // Return ke view dengan data kategori
        return view('dashboard', compact('categories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('librarian.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecategoryRequest $request)
    {
        category::create($request->validated());
        return redirect()->route('librarian.categories')->with('success', 'Category added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return view('librarian.category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoryRequest  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoryRequest $request, $id)
    {
        $category = category::find($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('librarian.categories')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Mencari kategori berdasarkan ID
        $category = category::find($id);

        // Mengecek apakah kategori memiliki buku yang terkait
        if ($category->books->count() > 0) {
            return redirect()->route('librarian.categories')->with('error', 'Cannot delete category because it has associated books.');
        }

        // Menghapus kategori jika tidak ada buku yang terkait
        $category->delete();

        // Mengembalikan response setelah penghapusan berhasil
        return redirect()->route('librarian.categories')->with('success', 'Category deleted successfully.');
    }

}

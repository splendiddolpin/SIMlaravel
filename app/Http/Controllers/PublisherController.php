<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use App\Http\Requests\StorepublisherRequest;
use App\Http\Requests\UpdatepublisherRequest;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  // App\Http\Controllers\PublisherController.php

    public function index(Request $request)
    {
        // Query untuk mengambil data publisher
        $query = Publisher::query();

        // Cek apakah ada parameter pencarian
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Ambil hasil query dengan pagination
        $publishers = $query->paginate(5);

        // Kembalikan view dengan data publisher dan parameter pencarian
        return view('librarian.publisher.index', [
            'publishers' => $publishers,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('librarian.publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepublisherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepublisherRequest $request)
    {
        publisher::create($request->validated());
        return redirect()->route('librarian.publishers')->with('success', 'Publisher added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function edit(publisher $publisher)
    {
        return view('librarian.publisher.edit', [
            'publisher' => $publisher
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepublisherRequest  $request
     * @param  \App\Models\publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepublisherRequest $request, $id)
    {
        $publisher = publisher::find($id);
        $publisher->name = $request->name;
        $publisher->save();

        return redirect()->route('librarian.publishers')->with('success', 'Publisher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Cari publisher berdasarkan ID
        $publisher = publisher::find($id);

        // Hapus publisher jika tidak ada referensi di tabel history
        $publisher->delete();

        return redirect()->route('librarian.publishers')->with('success', 'Publisher deleted successfully.');
    }

}

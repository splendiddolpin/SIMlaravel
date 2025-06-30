<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Settings;
use App\Models\BookIssue;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportsController extends Controller
{
    public function index()
    {
        return view('librarian.report.index');
    }

    public function date_wise()
    {
        $books = History::latest()->paginate(100);
        return view('librarian.report.dateWise', ['books' => '']);
    }

    public function month_wise()
    {
        $books = History::latest()->paginate(100);
        return view('librarian.report.monthWise', ['books' => '']);

    }

    public function generate_date_wise_report(Request $request)
    {
        $request->validate(['date' => "required|date"]);

        // Format input date agar sesuai dengan format di database
        $selectedDate = \Carbon\Carbon::parse($request->date)->format('Y-m-d');

        // Ambil data berdasarkan issue_date
        $books = History::whereDate('return_date', $selectedDate)
                        ->latest()
                        ->paginate(100);

        return view('librarian.report.dateWise', [
            'books' => $books, // Kirim data buku yang sudah dipaginasi ke view
        ]);
    }

    
    public function generate_month_wise_report(Request $request)
    {
        $request->validate(['month' => "required|date"]);

        // Mengambil data history dengan relasi 'student' untuk mendapatkan nama user/student
        $books = History::where('return_date', 'LIKE', '%' . $request->month . '%')
                        ->latest()
                        ->paginate(100); // Gunakan paginate(), jangan gunakan get()

        return view('librarian.report.monthWise', [
            'books' => $books, // Kirim data buku yang sudah dipaginasi ke view
        ]);
    }


    public function not_returned()
    {
        // Paginasi data history
        $books = \App\Models\History::latest()->paginate(100); // Sesuaikan jumlah item per halaman sesuai kebutuhan

        return view('librarian.report.notReturned', [
            'books' => $books, // Kirim data yang sudah dipaginasi ke view
        ]);
    }



}

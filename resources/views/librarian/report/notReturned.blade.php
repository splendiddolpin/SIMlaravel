@extends("librarian.layouts.app")
@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <h2 class="admin-heading text-center">Riwayat Peminjaman Buku</h2>
                </div>
            </div>
            @if ($books)
            <div class="row">
                <div class="col-md-12">
                    <table class="content-table">
                        <thead>
                            <th>S.No</th>
                            <th>Nama User</th>
                            <th>Book Name</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Over Days</th>
                            <th>Denda</th>
                        </thead>
                        <tbody>
                            @forelse ($books as $book)
                                <tr>
                                    <td>{{ $loop->iteration + $books->firstItem() - 1 }}</td>
                                    <td>{{ $book->student_name ?? 'Unknown' }}</td> <!-- Nama User dari kolom student_name -->
                                    <td>{{ $book->book_name ?? 'Unknown' }}</td> <!-- Nama Buku dari kolom book_name -->
                                    <td>{{ \Carbon\Carbon::parse($book->issue_date)->format('d M, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($book->return_date)->format('d M, Y') }}</td>
                                    <td>
                                        @php
                                            $borrowDate = Carbon\Carbon::parse($book->issue_date); // Tanggal peminjaman
                                            $returnDay = (int) $book->return_day; // Maksimal hari peminjaman
                                            $maxReturnDate = (clone $borrowDate)->addDays($returnDay); // Tanggal maksimal pengembalian
                        
                                            $actualReturnDate = $book->return_date ? Carbon\Carbon::parse($book->return_date) : null; // Tanggal pengembalian sebenarnya
                        
                                            // Jika belum dikembalikan atau tidak terlambat, overDays = 0
                                            $overDays = ($actualReturnDate && $actualReturnDate->greaterThan($maxReturnDate)) 
                                                        ? $actualReturnDate->diffInDays($maxReturnDate) 
                                                        : 0;
                        
                                            echo $overDays . ' days';
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                            // Ambil nilai denda dari record history
                                            $denda = $book->denda ?? 0; // Defaultkan denda ke 0 jika tidak ada
                                            $totalDenda = $overDays * $denda; // Hitung total denda
                                            echo "Rp " . number_format($totalDenda, 0, ',', '.'); // Format denda
                                        @endphp
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No Record Found!</td>
                                </tr>
                            @endforelse
                        </tbody>                        
                    </table>
                </div>
            </div>
        @endif        
        </div>
    </div>
@endsection

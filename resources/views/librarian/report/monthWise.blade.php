@extends("librarian.layouts.app")
@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <h2 class="admin-heading text-center">Monthwise Book Issue Report</h2>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-4 col-md-4">
                    <form class="yourform mb-5" action="{{ route('librarian.reports.month_wise_generate') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="month" name="month" class="form-control" value="{{ request('date', date('Y-m')) }}">
                        </div>
                        <input type="submit" class="btn btn-danger" name="search_month" value="Search">
                    </form>
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
                                    <td>{{ $book->student_name ?? 'Unknown' }}</td> <!-- Nama User dari relasi student -->
                                    <td>{{ $book->book_name ?? 'Unknown' }}</td> <!-- Nama Buku -->
                                    <td>{{ \Carbon\Carbon::parse($book->issue_date)->format('d M, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($book->return_date)->format('d M, Y') }}</td>
                                    <td>
                                        @php
                                            $borrowDate = \Carbon\Carbon::parse($book->issue_date); // Tanggal peminjaman
                                            $returnDay = (int) $book->return_day; // Maksimal hari peminjaman
                                            $maxReturnDate = (clone $borrowDate)->addDays($returnDay); // Tanggal maksimal pengembalian
                                            $actualReturnDate = \Carbon\Carbon::parse($book->return_date); // Tanggal pengembalian sebenarnya
                    
                                            // Hitung keterlambatan (hanya jika return_date lebih dari maxReturnDate)
                                            $overDays = $actualReturnDate->greaterThan($maxReturnDate) 
                                                        ? $actualReturnDate->diffInDays($maxReturnDate) 
                                                        : 0;
                    
                                            echo $overDays . ' days'; // Tampilkan jumlah hari keterlambatan
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                            // Ambil nilai denda dari setiap record history
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

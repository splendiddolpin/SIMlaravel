@extends('librarian.layouts.app')

@section('content')

    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="admin-heading">Pengembalian Buku</h2>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="yourform">
                        <table cellpadding="10px" width="90%" style="margin: 0 0 20px;">
                            <tr>
                                <td>Judul Buku : </td>
                                <td><b>{{ $book->book->name }}</b></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pinjam : </td>
                                <td><b>{{ $book->issue_date->format('d M, Y') }}</b></td>
                            </tr>
                            <tr>
                                <td>Tanggal Kembali : </td>
                                <td><b>{{ $book->return_date->format('d M, Y') }}</b></td>
                            </tr>
                            @if ($book->issue_status == 'Y')
                                <tr>
                                    <td>Status</td>
                                    <td><b>Returned</b></td>
                                </tr>
                                <tr>
                                    <td>Returned On</td>
                                    <td><b>{{ $book->return_day->format('d M, Y') }}</b></td>
                                </tr>
                            @else
                                @php
                                    $date1 = now();  // Tanggal sekarang
                                    $date2 = $book->return_date; // Tanggal pengembalian
                                    $overDays = 0;
                                    if ($date1 > $date2) {
                                        $diff = $date1->diff($date2);
                                        $overDays = $diff->days;
                                    }

                                    // Mengambil nilai denda dari tabel settings
                                    $denda = \App\Models\Settings::first()->denda ?? 0;
                                    $totalDenda = $overDays * $denda;
                                @endphp
                                @if ($overDays > 0)
                                    <tr>
                                        <td>Keterlambatan :</td>
                                        <td><b>{{ $overDays }} hari</b></td>
                                    </tr>
                                    <tr>
                                        <td>Denda :</td>
                                        <td><b>Rp {{ number_format($totalDenda, 0, ',', '.') }}</b></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>Keterlambatan :</td>
                                        <td><b>Tidak Terlambat</b><td>
                                    </tr>
                                @endif
                            @endif
                        </table>
                        <div class="d-flex justify-content-between">
                            @if ($book->issue_status == 'N')
                                <form action="{{ route('librarian.book_issue.update', $book->id) }}" method="post" autocomplete="off">
                                    @csrf
                                    <input type='submit' class='btn btn-danger' name='save' value='Pengembalian Buku'>
                                </form>
                            @endif
            
                            <a href="{{ route('librarian.book_issued') }}" class="btn btn-secondary ms-3">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

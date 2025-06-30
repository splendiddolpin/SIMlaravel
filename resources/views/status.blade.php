<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
@extends('layout.app')
@section('content')
<style>
    .custom-shadow {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Centered shadow around the table */
        border-radius: 8px; /* Optional: Rounded corners for the table */
    }
    #bookTable {
        width: 100%; /* Table width should always be 100% of available space */
        table-layout: fixed; /* Fix table layout to avoid overflow */
    }

    /* Media query for small screens */
    @media screen and (max-width: 768px) {
        #bookTable {
            font-size: 12px; /* Smaller text */
            width: 100%; /* Ensure full width */
        }

        #bookTable th, #bookTable td {
            padding: 5px; /* Smaller padding */
        }

        /* Make the table scrollable horizontally */
    }

    /* Media query for very narrow screens (portrait or landscape on small devices) */
    @media screen and (max-width: 480px) {
        #bookTable th, #bookTable td {
            padding: 3px; /* Further reduce padding for very small screens */
        }
    }
</style>
<header class="bg-white shadow mb-4">
    <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8 flex justify-between items-center flex-wrap lg:flex-nowrap gap-4">
  
        <!-- Bagian User Info di Kiri -->
        <div class="flex items-center space-x-4 lg:order-1">
            <!-- Icon Person -->
            <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-gray-200 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 sm:w-8 sm:h-8 text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 19.125a8.625 8.625 0 0115 0" />
                </svg>
            </div>
        
            <!-- Nama & Role -->
            <div>
                @if(Auth::check())
                    <h1 class="text-lg sm:text-xl font-bold text-gray-900">{{ auth()->user()->name }}</h1>
                    @if(auth()->user()->role == 'student')
                        <p class="text-green-600 font-medium text-sm">▪ Siswa</p>
                    @endif
                @else
                    <h1 class="text-lg sm:text-xl font-bold text-gray-900">Guest</h1>
                    <p class="text-gray-500 font-medium text-sm">Login untuk meminjam</p>
                @endif
            </div>
        </div>        
          
</header>

<main>
    <div class="d-flex justify-content-center">
        <div class="w-100" style="max-width: 1200px;">
            <div class="relative overflow-x-auto">
                <div class="mb-4 text-center">
                    <h2 class="text-2xl font-bold text-gray-900">Daftar Buku yang Dipinjam</h2>
                    <p class="text-gray-700">Berikut adalah daftar buku yang sedang Anda pinjam. Pastikan untuk mengembalikan buku tepat waktu agar terhindar dari denda keterlambatan.</p>
                </div>
                @if($bookIssues->isEmpty())
                    <p class="text-gray-500 text-center">Belum ada buku yang dipinjam.</p>
                @else
                <table class="table table-bordered table-hover table-sm w-full text-sm text-left text-black custom-shadow" id="bookTable">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-6 py-3">Buku</th>
                            <th scope="col" class="px-6 py-3">Tanggal Peminjaman</th>
                            <th scope="col" class="px-6 py-3">Tanggal Pengembalian</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Keterlambatan</th>
                            <th scope="col" class="px-6 py-3">Total Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookIssues as $issue)
                        <tr class="align-middle">
                            <td class="px-6 py-4">{{ $issue->book->name }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($issue->issue_date)->translatedFormat('l, d F Y') }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($issue->return_date)->translatedFormat('l, d F Y') }}</td>
                            <td class="px-6 py-4">
                                @if($issue->issue_status === 'N')
                                    <p class="text-danger text-sm">Belum Dikembalikan</p>
                                @else
                                    Returned
                                @endif
                            </td>
                            <td>{{ $issue->late_days }} Hari</td>
                            <td class="px-6 py-4">
                                Rp {{ number_format($issue->rental_price + $issue->calculated_penalty, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <span class="text-danger text-sm">*Denda dikali Rp.{{$dendaRate}} perhari dengan maksimal pengembalian {{$returndays}} hari dari hari peminjaman</span>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection

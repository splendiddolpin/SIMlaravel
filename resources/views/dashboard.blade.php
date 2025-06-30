<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
<style>
.cover-image {
    object-fit: cover; /* Menjaga gambar untuk mengisi kontainer dengan mempertahankan proporsi */
    width: ; /* Gambar akan mengisi seluruh lebar kontainer */
    height: 200px; /* Mengatur tinggi gambar agar tetap seragam */
    border-radius: 5px; /* Menambahkan sudut melengkung pada gambar */
}
.card-title {
    font-weight: bold; /* Membuat judul menjadi tebal */
    font-size: 1.5rem;  /* Menentukan ukuran font yang lebih besar */
}
.status-badge {
    font-size: 0.8rem; /* Membuat ukuran teks lebih kecil */
    padding: 0.25rem 0.5rem; /* Padding lebih kecil */
    display: inline-block;
    border-radius: 0.25rem;
    position: absolute;
    bottom: 10px; /* Menempatkan status di bagian bawah card */
    right: 10px; /* Menempatkan status di pojok kanan */
}
.card {
    position: relative; /* Menentukan posisi relatif untuk card agar status badge dapat diposisikan dengan benar */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3); /* Efek bayangan */
}
.modal-body {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.modal-body .col-md-6 {
    padding: 1rem; /* Menambahkan padding untuk memberi ruang antar elemen */
}

.modal-body .col-md-6 img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    object-fit: cover; /* Menjaga gambar terpotong dengan baik */
}

.card-title {
    font-weight: bold;
    font-size: 1.25rem; /* Ukuran font lebih besar untuk judul */
    margin-bottom: 1rem;
}

.card-text {
    font-size: 1rem; /* Ukuran font normal untuk detail */
    margin-bottom: 0.5rem;
}

.cover-image {
    object-fit: cover; /* Menjaga gambar tetap sesuai ukuran tanpa terdistorsi */
    width: 100%; /* Lebar gambar menyesuaikan kontainer */
    height: 350px; /* Menentukan tinggi tetap agar tetap proporsional */
    border-radius: 5px; /* Memberikan sudut melengkung pada gambar */
}

.cover-image2 {
    object-fit: cover; /* Memastikan gambar mengisi ruang tanpa distorsi */
    width: 500px; /* Lebar tetap untuk menjaga potret */
    height: 400px; /* Tinggi tetap untuk menjaga potret */
    border-radius: 10px; /* Sudut melengkung agar tidak runcing */
}

.sinopsis {
    font-size: 0.9rem; /* Ukuran font lebih kecil untuk sinopsis */
    max-height: 80px; /* Batasi tinggi sinopsis */
    overflow: hidden; /* Sembunyikan teks yang melebihi batas */
    text-overflow: ellipsis; /* Tambahkan elipsis jika teks dipotong */
    white-space: normal; /* Biarkan teks ter-wrap dengan baik */
}

@media (max-width: 768px) {
    .modal-body .col-md-6 img {
        display: none;
    }
    .modal-body {
        flex-direction: column; /* Menyusun menjadi satu kolom pada perangkat kecil */
        gap: 1rem;
    }
    .modal-body .col-md-6 {
        width: 100%; /* Membuat kolom menjadi penuh pada perangkat kecil */
        padding: 0; /* Mengurangi padding pada kolom untuk lebih efisien */
    }
    .cover-image2 {
    object-fit: cover; /* Memastikan gambar mengisi ruang tanpa distorsi */
    width: 300px; /* Lebar tetap untuk menjaga potret */
    height: 400px; /* Tinggi tetap untuk menjaga potret */
    border-radius: 10px; /* Sudut melengkung agar tidak runcing */
}
}

</style>
@extends('layout.app')
@section('content')

<header class="bg-white shadow">
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
  
      <!-- Search Bar di Kanan -->
      <div class="w-full sm:max-w-xs lg:w-1/3 lg:order-2">
        <form method="GET" action="{{ route('guest.search') }}">
          <label for="default-search" class="sr-only">Search</label>
          <div class="relative">
              <input type="search" id="default-search" name="q" value="{{ request('q') }}"
                     class="block w-full p-3 pr-16 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" 
                     placeholder="Cari buku atau penulis..." required />
              <button type="submit" 
                      class="absolute right-2 top-1/2 -translate-y-1/2 bg-blue-700 hover:bg-blue-800 text-white font-medium rounded-md text-sm px-4 py-2">
                  Search
              </button>
          </div>
        </form>
      </div>
    </div>
</header>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @forelse ($books as $book)
            <div class="col">
                <div class="card mb-3 shadow-md" data-bs-toggle="modal" data-bs-target="#detailModal{{ $book->id }}">
                    <div class="row g-0">
                        <!-- Cover Image -->
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            @if ($book->cover_image)
                                <img src="{{ asset($book->cover_image) }}" alt="Cover of {{ $book->name }}" 
                                     class="img-fluid rounded-start cover-image">
                            @else
                            <img src="{{ asset('images/defaultc.png') }}" alt="Default Cover" 
                            class="img-fluid rounded-start cover-image">
                            @endif
                        </div>
                        <!-- Book Details -->
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold" style="font-size: 1.25rem;">{{ $book->name }}</h5>
                                <p class="card-text"><strong>Category:</strong> {{ $book->category->name }}</p>
                                <p class="card-text"><strong>Author:</strong> {{ $book->auther->name }}</p>
                                <p class="card-text"><strong>Publisher:</strong> {{ $book->publisher->name }}</p>
            
                                <!-- Sinopsis -->
                                <p class="card-text sinopsis">
                                    {{ $book->sinopsis ? $book->sinopsis : 'No synopsis available for this book.' }}
                                </p>
                            </div>
                        </div>
                    </div>
            
                    <!-- Status Badge -->
                    <span class="badge 
                        {{ $book->status == 'Y' ? 'bg-success' : 'bg-danger' }} 
                        text-white status-badge">
                        {{ $book->status == 'Y' ? 'Tersedia' : 'Dipinjam' }}
                    </span>
                </div>
            </div>
            
            <!-- Modal untuk setiap buku -->
            <div class="modal fade" id="detailModal{{ $book->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $book->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel{{ $book->id }}">{{ $book->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Left Side - Book Details -->
                                <div class="col-md-6">
                                    <h5 class="card-title font-weight-bold">{{ $book->name }}</h5>
                                    <p class="card-text"><strong>Category:</strong> {{ $book->category->name }}</p>
                                    <p class="card-text"><strong>Author:</strong> {{ $book->auther->name }}</p>
                                    <p class="card-text"><strong>Publisher:</strong> {{ $book->publisher->name }}</p>
                                    @if (!empty($book->product_code))
                                        <div class="mt-2">
                                            <strong>QR Code:</strong>
                                            {!! DNS2D::getBarcodeHTML(route('librarian.detail', ['id' => $book->id]), 'QRCODE') !!}
                                        </div>
                                    @else
                                        <p class="text-muted">Product code is missing.</p>
                                    @endif
                                </div>
                                
                                <!-- Right Side - Book Cover Image (only visible on desktop) -->
                                <div class="col-md-6 d-flex align-items-center justify-content-center">
                                    @if ($book->cover_image)
                                        <img src="{{ asset($book->cover_image) }}" alt="Cover of {{ $book->name }}" class="cover-image2">
                                    @else
                                    <img src="{{ asset('images/defaultc.png') }}" alt="Default Image" class="cover-image2">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            @empty
            <div class="col">
                <p class="text-center text-muted">No Books Found</p>
            </div>
            @endforelse
        </div>
        </div>
    
        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $books->links('pagination::simple-bootstrap-4') }} <!-- Atau pagination yang sesuai dengan versi Anda -->
        </div>        
    
        <!-- Showing pagination info -->
        <div class="mt-2 text-center">
            <p>Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }} results</p>
        </div>
    </div>


</main>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header bg-success text-white">
              <h5 class="modal-title" id="successModalLabel">Success</h5>
          </div>
          <div class="modal-body">
              <p>{{ session('success') }}</p>
          </div>
      </div>
  </div>
</div>

@if(session('success'))
<script>
  document.addEventListener('DOMContentLoaded', function () {
      var successModal = new bootstrap.Modal(document.getElementById('successModal'));
      successModal.show();
  });
</script>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

@endsection



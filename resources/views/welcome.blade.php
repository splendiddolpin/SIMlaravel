<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-Library</title>

  <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
  <link rel="icon" href="{{ asset('img/favicon.svg')}}">
  <style>
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>

<body class="leading-normal tracking-normal" style="font-family: 'Montserrat', sans-serif">


  <!-- Header -->

  <!--Hero-->
  <div class="pt-24 px-16 bg-blue-200">
    <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
      <!--Left Col-->
      <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left text-gray-800">
        <h1 class="my-4 text-4xl font-bold leading-tight">
          Perpustakaan SMP Negeri 13 Magelang
        </h1>
        <p class="leading-normal text-1xl mb-8">
          Buku adalah jendela dunia. Semakin banyak membaca, semakin luas wawasanmu!
        </p>
        <button
          class="mx-auto lg:mx-0 bg-blue-500 text-white font-bold rounded-md my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
          <a href="{{ route('guest.books') }}">Pinjam Sekarang!</a>
        </button>
      </div>
      <!--Right Col-->
      <div class="w-full md:w-3/5 flex justify-center">
        <img class="object-fill mx-auto md:mx-36 transform transition hover:scale-110 duration-300 ease-in-out"
          src="{{ asset('img/baca.png')}}" />
      </div>
    </div>
</div>
  <!-- How -->
  <div id="how" class="container my-20 mx-auto px-4 md:px-12">
    <div class="flex flex-wrap -mx-1 lg:-mx-4 justify-center">
      <!-- Column -->
      <div class="my-1 px-1 w-full sm:w-3/4 md:w-1/2 lg:my-4 lg:px-4 lg:w-1/4">
        <!-- Article -->
        <article class="overflow-hidden rounded-lg shadow-lg text-gray-800 p-4 sm:p-2">
          <img alt="Tulis"
            class="block h-auto w-20 sm:w-24 lg:w-28 mx-auto my-6 sm:my-8 transform transition hover:scale-125 duration-300 ease-in-out"
            src="{{ asset('img/buku2.jpg')}}" />
          <header class="leading-tight p-2 md:p-4 text-center">
            <h1 class="text-lg font-bold">1. Pilih Buku</h1>
            <p class="text-grey-darker text-sm py-4">
              Pilih terlebih dahulu buku yang ingin dipinjam.
            </p>
          </header>
        </article>
        <!-- END Article -->
      </div>
      <!-- END Column -->
      <!-- Column -->
      <div class="my-1 px-1 w-full sm:w-3/4 md:w-1/2 lg:my-4 lg:px-4 lg:w-1/4">
        <!-- Article -->
        <article class="overflow-hidden rounded-lg shadow-lg text-gray-800 p-4 sm:p-2">
          <img alt="Proses"
            class="block h-auto w-20 sm:w-24 lg:w-28 mx-auto my-6 sm:my-8 transform transition hover:scale-125 duration-300 ease-in-out"
            src="{{ asset('img/scan.jpg')}}" />
          <header class="leading-tight p-2 md:p-4 text-center">
            <h1 class="text-lg font-bold">2. Scan QR Code</h1>
            <p class="text-grey-darker text-sm py-4">
              Lakukan scan QR Code untuk meminjam buku.
            </p>
          </header>
        </article>
        <!-- END Article -->
      </div>
      <!-- END Column -->
      <!-- Column -->
      <div class="my-1 px-1 w-full sm:w-3/4 md:w-1/2 lg:my-4 lg:px-4 lg:w-1/4">
        <!-- Article -->
        <article class="overflow-hidden rounded-lg shadow-lg text-gray-800 p-4 sm:p-2">
          <img alt="Ditindak"
            class="block h-auto w-20 sm:w-24 lg:w-28 mx-auto my-6 sm:my-8 transform transition hover:scale-125 duration-300 ease-in-out"
            src="{{ asset('img/status.jpg')}}" />
          <header class="leading-tight p-2 md:p-4 text-center">
            <h1 class="text-lg font-bold">3. Cek Status</h1>
            <p class="text-grey-darker text-sm py-4">
              Pastikan cek ketersediaan buku.
            </p>
          </header>
        </article>
        <!-- END Article -->
      </div>
      <!-- END Column -->
      <!-- Column -->
      <div class="my-1 px-1 w-full sm:w-3/4 md:w-1/2 lg:my-4 lg:px-4 lg:w-1/4">
        <!-- Article -->
        <article class="overflow-hidden rounded-lg shadow-lg text-gray-800 p-4 sm:p-2">
          <img alt="Selesai"
            class="block h-auto w-20 sm:w-24 lg:w-28 mx-auto my-6 sm:my-8 transform transition hover:scale-125 duration-300 ease-in-out"
            src="{{ asset('img/centang.png')}}" />
          <header class="leading-tight p-2 md:p-4 text-center">
            <h1 class="text-lg font-bold">4. Selesai</h1>
            <p class="text-grey-darker text-sm py-4">
              Buku sudah berhasil dipinjam dan dapat dilihat di status.
            </p>
          </header>
        </article>
        <!-- END Article -->
      </div>
      <!-- END Column -->
    </div>
</div>

  <!-- Footer -->
  <footer class="text-center font-medium bg-blue-200 py-5">
    © 2025 E-LIBRARY | By
    <a href="" target="_blank">Kiki</a>
  </footer>
  @include('sweetalert::alert')
</body>

</html>
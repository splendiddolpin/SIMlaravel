<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>

    <style>
        /* Gaya untuk tautan navigasi */
        .nav-link {
            text-decoration: none;
            padding: 8px 16px;
            font-size: 1rem;
            color: #f3f4f6;
        }

        .nav-link:hover {
            background-color: #4b5563;
            color: white;
        }

        /* Tampilan gambar profil */
        .profile-image {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <img class="h-8 w-8" src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg" alt="Tailwind CSS">


                        </div>
                        <div class="ml-10 flex items-baseline space-x-4">
                            @if(Auth::check())
                            <a href="{{ route('student.dashboard') }}" class="nav-link">Daftar Buku</a>
                            <a href="{{ route('status.user') }}" class="nav-link">Status</a>
                            @else
                            <a href="{{ route('guest.books') }}" class="nav-link">Daftar Buku</a>
                            @endif
                            @if(auth()->check())
                            <a href="{{ route('logout') }}" class="nav-link">Logout</a>
                            @else
                            <a href="{{ route('login.form') }}" class="nav-link">Login</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div>
            @yield('content')
        </div>
    </div>
</body>
</html>

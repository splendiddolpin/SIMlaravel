<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
<style>
    .custom-column {
        width: 25px;
    }
    .synopsis {
        text-align: justify;
        line-height: 1.4;
    }
    .synopsis p {
        margin-bottom: 0.00005rem;
        font-size: 1rem;
        word-wrap: break-word;
    }
    .custom-btn {
        padding: 10px 20px;
        border: 1px solid blue;
        background-color: transparent;
        color: blue;
        font-size: 13px;
        font-weight: normal;
        text-transform: uppercase;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        border-radius: 7px;
        outline: none;
    }
    .custom-btn span {
        color: blue;
    }
    .custom-btn:hover {
        background-color: blue;
        color: white;
    }
    .custom-btn:hover span {
        color: white;
    }
    .custom-btn:active {
        background-color: darkblue;
        color: white;
    }

    /* Styling untuk pesan yang muncul */
    .rented-message {
        color: red;
        font-size: 14px;
        font-weight: bold;
        display: none; /* Sembunyikan pesan secara default */
        text-align: center; /* Menengahkan teks secara horizontal */
        margin-top: 10px; /* Memberikan sedikit jarak di atas pesan */
        padding: 5px; /* Memberikan sedikit padding di sekitar pesan */
        background-color: #f8d7da; /* Background dengan warna merah muda agar terlihat jelas */
        border: 1px solid red; /* Memberikan border merah */
        border-radius: 5px; /* Sudut yang sedikit melengkung */
    }
</style>

<div class="bg-light py-8">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex flex-column justify-content-left">
                            <img 
                                src="{{ asset($book->cover_image) }}" 
                                class="img-fluid rounded-start" 
                                alt="Cover of {{ $book->name }}">
                            <div class="mt-3">
                                <div class="container">
                                    <div class="col-12 mb-2 text-start">
                                        <strong><i class="fas fa-tag"></i> Category: </strong>{{ $book->category->name }}
                                    </div>
                                    <div class="col-12 mb-2 text-start">
                                        <strong><i class="fas fa-check-circle"></i> Availability: </strong>
                                        @if ($book->status == 'Y')
                                            <span class="badge bg-success">Available</span>
                                        @else
                                            <span class="badge bg-danger">Issued</span>
                                        @endif
                                    </div>
                                    <div class="col-12 mb-2 text-start">
                                        <strong><i class="fas fa-user"></i> Author: </strong>{{ $book->auther->name }}
                                    </div>
                                    <div class="col-12 mb-2 text-start">
                                        <strong><i class="fas fa-building"></i> Publisher: </strong>{{ $book->publisher->name }}
                                    </div>
                                    <div class="col-12 mb-2 text-start">
                                        <strong><i class="fas fa-money-bill-alt"></i> Rental Price: </strong>Gratis
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-1 d-flex align-items-center custom-column">
                            <hr class="border-0" style="border-left: 2px solid #ccc; height: 100%;"/>
                        </div>

                        <div class="col-md-7">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <strong><i class="fas fa-book-open"></i> Synopsis: </strong>
                                        <p style="text-align: justify; text-indent: 20px; margin-top:10px;">{{ $book->sinopsis ? $book->sinopsis : 'No synopsis available for this book.' }}</p>
                                    </div>
                                </div>

                                <!-- Rent and Back Buttons -->
                                <form action="{{ route('rent') }}" method="POST" id="rent-form">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="submit" class="custom-btn" id="rent-btn">
                                            @if(Auth::check())
                                                Pinjam
                                            @else
                                                <span>Login untuk meminjam</span>
                                            @endif
                                        </button>
                                        <a href="{{ Auth::check() ? route('student.dashboard') : route('guest.books') }}" class="btn btn-secondary">
                                            Back
                                        </a>
                                    </div>
                                </form>

                                <!-- Message for issued books -->
                                <div class="rented-message" id="rented-message">
                                    This book is currently issued and cannot be rented.
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Check if the book is issued
    const bookStatus = '{{ $book->status }}'; // Status of the book, 'Y' or 'N'
    
    // Add event listener to Rent button
    document.getElementById('rent-btn').addEventListener('click', function(event) {
        // If the book is issued, prevent form submission and show the message
        if (bookStatus === 'N') {
            event.preventDefault(); // Prevent form submission
            document.getElementById('rented-message').style.display = 'block'; // Show the message
        }
    });
</script>

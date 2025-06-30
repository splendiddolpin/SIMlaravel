<!-- resources/views/partials/book-detail.blade.php -->
<div class="row">
    <!-- Book Details -->
    <div class="col-md-6">
        <h5>{{ $book->name }}</h5>
        <p><strong>Category:</strong> {{ $book->category->name }}</p>
        <p><strong>Author:</strong> {{ $book->author->name }}</p>
        <p><strong>Publisher:</strong> {{ $book->publisher->name }}</p>
        @if ($book->product_code)
        <div>
            <strong>QR Code:</strong>
            {!! DNS2D::getBarcodeHTML(route('librarian.detail', ['id' => $book->id]), 'QRCODE') !!}
        </div>
        @else
        <p>Product code is missing.</p>
        @endif
    </div>
    <!-- Book Cover -->
    <div class="col-md-6">
        @if ($book->cover_image)
        <img src="{{ asset($book->cover_image) }}" class="img-fluid" alt="Cover of {{ $book->name }}">
        @else
        <div class="bg-secondary text-white text-center p-4" style="height: 200px;">
            No Cover Image
        </div>
        @endif
    </div>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code for {{ $book->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .qr-container {
            text-align: center;
        }
        .qr-container img {
            margin-top: 20px;
        }
        .book-info {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="qr-container">
        <h2>QR Code for {{ $book->name }}</h2>
        {!! $qrCode !!}
    </div>
    <div class="book-info">
        <p><strong>Book Name:</strong> {{ $book->name }}</p>
        <p><strong>Author:</strong> {{ $book->auther->name }}</p>
        <p><strong>Category:</strong> {{ $book->category->name }}</p>
        <p><strong>Publisher:</strong> {{ $book->publisher->name }}</p>
    </div>
</body>
</html>

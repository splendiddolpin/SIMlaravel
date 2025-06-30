@extends('librarian.layouts.app')

@section('content')

    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="admin-heading">Daftar Buku</h2>
                </div>
                <div class="col-md-6 d-flex">
                    <!-- Form Pencarian -->
                    <form action="{{ route('librarian.books') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="search" placeholder="Search by title or author" value="{{ request('search') }}" class="form-control">
                    </form>
                </div>
                <div class="col-md-3 text-right">
                    <a class="add-new" href="{{ route('librarian.book.create') }}">Tambah Buku</a>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <p class="text-muted">*Jika tombol delete tidak berfungsi menandakan buku sedang dipinjam. untuk mengaktifkan kembali tunggu buku dikembalikan terlebih dahulu</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="message"></div>
                    <table class="content-table">
                        <thead>
                            <th>S.No</th>
                            <th>Book Name</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Status</th>
                            <th>QR Code</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @forelse ($books as $book)
                                @php
                                    // Generate URL for the target page
                                    $redirectUrl = route('librarian.detail', ['id' => $book->id]);
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration + $books->firstItem() - 1 }}</td>
                                    <td>{{ $book->name }}</td>
                                    <td>{{ $book->category->name }}</td>
                                    <td>{{ $book->auther->name }}</td>
                                    <td>{{ $book->publisher->name }}</td>
                                    <td>
                                        @if ($book->status == 'Y')
                                            <span class='badge badge-success'>Tersedia</span>
                                        @else
                                            <span class='badge badge-danger'>Dipinjam</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($book->product_code))
                                            <!-- View Button that triggers modal -->
                                            <button class="btn btn-primary view-qr" data-toggle="modal" data-target="#qrModal-{{ $book->id }}" data-qr="{{ DNS2D::getBarcodeHTML($redirectUrl, 'QRCODE') }}">View</button>
                                        @else
                                            <span>Product code is missing.</span>
                                        @endif
                                    </td>
                                    <td class="edit">
                                        <a href="{{ route('librarian.book.edit', $book) }}" class="btn btn-success">Edit</a>
                                    </td>
                                    <td class="delete">
                                        @if ($book->status == 'Y')
                                            <button type="button" class="btn btn-danger delete-book"
                                                data-id="{{ $book->id }}"
                                                data-name="{{ $book->name }}"
                                                data-url="{{ route('librarian.book.destroy', $book) }}">
                                                Delete
                                            </button>
                                        @else
                                            <button class="btn btn-danger" disabled>Delete</button>
                                        @endif
                                    </td>                                                             
                                </tr>

                                <!-- Modal for QR Code -->
                                <div class="modal fade" id="qrModal-{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel-{{ $book->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="qrModalLabel-{{ $book->id }}">QR Code for {{ $book->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Display the QR Code inside the modal -->
                                                <div class="qr-code-container">
                                                    {!! DNS2D::getBarcodeHTML($redirectUrl, 'QRCODE') !!}
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ route('librarian.book.download_qr', $book->id) }}" class="btn btn-success">Download PDF</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="8">No Books Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $books->links('vendor/pagination/bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus buku <span id="bookName"></span>?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Sukses</h5>
                </div>
                <div class="modal-body">
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            alert("{{ session('error') }}");
        });
    </script>
    @endif

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
    </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".delete-form").forEach(form => {
                form.addEventListener("submit", function (event) {
                    event.preventDefault(); // Mencegah submit langsung

                    let bookName = form.querySelector(".delete-book").getAttribute("data-name");

                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: `Buku "${bookName}" akan dihapus secara permanen!`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Lanjutkan submit jika dikonfirmasi
                        }
                    });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-book'); // Ambil semua tombol delete
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal')); // Modal Bootstrap
            const deleteForm = document.getElementById('deleteForm'); // Form penghapusan
            const bookNameSpan = document.getElementById('bookName'); // Nama buku di modal

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const bookId = this.getAttribute('data-id'); // Ambil ID buku
                    const bookName = this.getAttribute('data-name'); // Ambil nama buku
                    const deleteUrl = this.getAttribute('data-url'); // Ambil URL DELETE

                    deleteForm.setAttribute('action', deleteUrl); // Setel URL action di form
                    bookNameSpan.textContent = bookName; // Tampilkan nama buku di modal
                    deleteModal.show(); // Tampilkan modal konfirmasi
                });
            });
        });
    </script>
    
@endsection

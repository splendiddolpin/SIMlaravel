@extends('librarian.layouts.app')
@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="admin-heading">Pengarang</h2>
                </div>
                <div class="col-md-4">
                    <!-- Form Pencarian Author -->
                    <form action="{{ route('librarian.authors') }}" method="GET" class="d-flex">
                        <input type="text" name="search" placeholder="Search by author name" value="{{ request('search') }}" class="form-control">
                    </form>
                </div>
                <div class="col-md-2 offset-md-3">
                    <a class="add-new" href="{{ route('librarian.authors.create') }}">+ Pengarang</a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <p class="text-muted">*Jika tombol delete tidak berfungsi menandakan nama author sedang dipakai didalam data buku. untuk mendelete silahkan hapus nama author terkait disemua data buku</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="message"></div>
                    <table class="content-table">
                        <thead>
                            <th>S.No</th>
                            <th>Author Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @forelse ($authors as $author)
                            <tr>
                                <td>{{ $loop->iteration + $authors->firstItem() - 1 }}</td>
                                <td>{{ $author->name }}</td>
                                <td class="edit">
                                    <a href="{{ route('librarian.authors.edit', $author) }}" class="btn btn-success">Edit</a>
                                </td>
                                <td class="delete">
                                    <!-- Cek apakah author memiliki buku terkait -->
                                    @if ($author->books->count() > 0)
                                        <button class="btn btn-danger" disabled>Delete</button>
                                    @else
                                        <button class="btn btn-danger delete-author" data-id="{{ $author->id }}" data-name="{{ $author->name }}">Delete</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Authors Found</td>
                                </tr>
                            @endforelse
                        </tbody>                        
                    </table>
                    {{ $authors->links('vendor/pagination/bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <span id="authorName"></span>?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <p>{{ session('success') }}</p>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> --}}
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-author'); // Ambil semua tombol delete
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal')); // Modal Bootstrap
            const deleteForm = document.getElementById('deleteForm'); // Formulir penghapusan
            const authorNameSpan = document.getElementById('authorName'); // Elemen untuk nama penulis
    
            // Tambahkan event listener ke setiap tombol delete
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const authorId = this.getAttribute('data-id'); // Ambil ID penulis
                    const authorName = this.getAttribute('data-name'); // Ambil nama penulis
                    const deleteUrl = `{{ url('librarian/authors/delete') }}/${authorId}`; // URL aksi formulir
    
                    deleteForm.setAttribute('action', deleteUrl); // Setel URL aksi di form
                    authorNameSpan.textContent = authorName; // Tampilkan nama penulis di modal
                    deleteModal.show(); // Tampilkan modal
                });
            });
        });
    </script>    
@endsection

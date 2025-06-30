@extends('librarian.layouts.app')
@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="admin-heading">Kategori</h2>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('librarian.categories') }}" method="GET" class="d-flex">
                        <input type="text" name="search" placeholder="Search by category name" value="{{ request('search') }}" class="form-control">
                    </form>
                </div>
                <div class="col-md-2 offset-md-3">
                    <a class="add-new" href="{{ route('librarian.category.create') }}">+ Kategori</a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <p class="text-muted">*Jika tombol delete tidak berfungsi menandakan nama kategori sedang dipakai didalam data buku. untuk mendelete silahkan hapus jenis kategori terkait disemua data buku</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="message"></div>
                    <table class="content-table">
                        <thead>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration + $categories->firstItem() - 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="edit">
                                        <a href="{{ route('librarian.category.edit', $category) }}" class="btn btn-success">Edit</a>
                                    </td>
                                    <td class="delete">
                                        @if ($category->books->count() > 0)
                                            <button class="btn btn-danger" disabled>Delete</button>
                                        @else
                                            <button class="btn btn-danger delete-category" 
                                                    data-id="{{ $category->id }}" 
                                                    data-name="{{ $category->name }}">
                                                Delete
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Category Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>                    
                    {{ $categories->links('vendor/pagination/bootstrap-4') }}
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
                    <p>Are you sure you want to delete <span id="categoryName"></span>?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
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
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal')); // Modal Bootstrap
            const deleteForm = document.getElementById('deleteForm'); // Formulir penghapusan
            const categoryNameSpan = document.getElementById('categoryName'); // Elemen untuk nama kategori

            // Event delegation untuk tombol delete
            document.addEventListener('click', function (event) {
                if (event.target && event.target.classList.contains('delete-category')) {
                    const button = event.target; // Tombol yang diklik
                    const categoryId = button.getAttribute('data-id'); // Ambil ID kategori
                    const categoryName = button.getAttribute('data-name'); // Ambil nama kategori
                    const deleteUrl = `{{ url('librarian/category/delete') }}/${categoryId}`; // URL aksi formulir

                    deleteForm.setAttribute('action', deleteUrl); // Setel URL aksi di form
                    categoryNameSpan.textContent = categoryName; // Tampilkan nama kategori di modal
                    deleteModal.show(); // Tampilkan modal
                }
            });
        });
    </script>
@endsection

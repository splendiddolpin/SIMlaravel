@extends('librarian.layouts.app')
@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="admin-heading">Penerbit</h2>
                </div>
                <div class="col-md-4">
                    <!-- Form Pencarian Publisher -->
                    <form action="{{ route('librarian.publishers') }}" method="GET" class="d-flex">
                        <input type="text" name="search" placeholder="Search by publisher name" value="{{ request('search') }}" class="form-control">
                    </form>
                </div>
                <div class="col-md-2 offset-md-3">
                    <a class="add-new" href="{{ route('librarian.publisher.create') }}">+ Penerbit</a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <p class="text-muted">*Jika tombol delete tidak berfungsi menandakan nama publisher sedang dipakai didalam data buku. untuk mendelete silahkan hapus nama publisher terkaitdisemua data buku</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="message"></div>
                    <table class="content-table">
                        <thead>
                            <th>ID</th>
                            <th>Publisher Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @forelse ($publishers as $publisher)
                            <tr>
                                <td>{{ $loop->iteration + $publishers->firstItem() - 1 }}</td>
                                <td>{{ $publisher->name }}</td>
                                <td class="edit">
                                    <a href="{{ route('librarian.publisher.edit', $publisher) }}" class="btn btn-success">Edit</a>
                                </td>
                                <td class="delete">
                                    <!-- Cek apakah publisher memiliki buku terkait -->
                                    @if ($publisher->books->count() > 0)
                                        <button class="btn btn-danger" disabled>Delete</button>
                                    @else
                                        <button class="btn btn-danger delete-publisher" data-id="{{ $publisher->id }}" data-name="{{ $publisher->name }}">Delete</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Publisher Found</td>
                                </tr>
                            @endforelse
                        </tbody>                        
                    </table>
                    {{ $publishers->links('vendor/pagination/bootstrap-4') }}
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
                    <p>Are you sure you want to delete <span id="publisherName"></span>?</p>
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
            var errorMessage = "{{ session('error') }}";
            alert(errorMessage); // Anda bisa menampilkan pesan error dengan alert atau di dalam modal
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
            const deleteButtons = document.querySelectorAll('.delete-publisher'); // Ambil semua tombol delete
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal')); // Modal Bootstrap
            const deleteForm = document.getElementById('deleteForm'); // Formulir penghapusan
            const publisherNameSpan = document.getElementById('publisherName'); // Elemen untuk nama penulis
    
            // Tambahkan event listener ke setiap tombol delete
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const publisherId = this.getAttribute('data-id'); // Ambil ID penulis
                    const publisherName = this.getAttribute('data-name'); // Ambil nama penulis
                    const deleteUrl = `{{ url('librarian/publisher/delete') }}/${publisherId}`; // URL aksi formulir
    
                    deleteForm.setAttribute('action', deleteUrl); // Setel URL aksi di form
                    publisherNameSpan.textContent = publisherName; // Tampilkan nama penulis di modal
                    deleteModal.show(); // Tampilkan modal
                });
            });
        });
    </script>
@endsection

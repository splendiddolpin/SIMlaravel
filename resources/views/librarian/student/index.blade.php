@extends('librarian.layouts.app')
@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="admin-heading">All Students</h2>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('librarian.students') }}" method="GET" class="d-flex">
                        <input type="text" name="search" placeholder="Search by student name" value="{{ request('search') }}" class="form-control">
                    </form>
                </div>
                <div class="col-md-2 offset-md-3">
                    <a class="add-new" href="{{ route('librarian.student.create') }}">Tambah Siswa</a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <p class="text-muted">*Jika tombol delete tidak berfungsi menandakan nama student sedang meminjam. Untuk mendelete silahkan edit bagian peminjaman buku / tunggu siswa untuk mengembalikan buku.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="message"></div>
                    <table class="content-table">
                        <thead>
                            <th>S.No</th>
                            <th>Student Name</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration + $students->firstItem() - 1 }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td class="text-capitalize">
                                        @if ($student->gender === 'male')
                                            Laki-laki
                                        @elseif ($student->gender === 'female')
                                            Perempuan
                                        @else
                                            {{ $student->gender }}
                                        @endif
                                    </td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td class="edit">
                                        <a href="{{ route('librarian.student.edit', $student) }}" class="btn btn-success">Edit</a>
                                    </td>
                                    <td class="delete">
                                        @if($student->bookIssues()->count() > 0)
                                            <button class="btn btn-danger" disabled>Delete</button>
                                        @else
                                            <button class="btn btn-danger delete-student" data-id="{{ $student->id }}" data-name="{{ $student->name }}">Delete</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">No Students Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $students->links('vendor/pagination/bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                </div>
                <div class="modal-body">
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        });
    </script>
    @endif


    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <span id="studentName"></span>?</p>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Handle delete button click
            const deleteButtons = document.querySelectorAll('.delete-student');
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const deleteForm = document.getElementById('deleteForm');
            const studentNameSpan = document.getElementById('studentName');
    
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const studentId = this.getAttribute('data-id');
                    const studentName = this.getAttribute('data-name');
    
                    // Set form action dynamically
                    deleteForm.action = `/librarian/student/delete/${studentId}`;
                    studentNameSpan.textContent = studentName;
    
                    // Show the modal
                    deleteModal.show();
                });
            });
        });
    </script>
    
@endsection

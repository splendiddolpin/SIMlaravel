@extends('librarian.layouts.app')
@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="admin-heading">Pengaturan</h2>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    @if(session('success'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                                successModal.show();
                            });
                        </script>
                    @endif
                    <form class="yourform" id="settingsForm" action="{{ route('librarian.settings.update') }}" method="post" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Maksimal Tanggal Pengembalian</label>
                            <input type="number" class="form-control" name="return_days" value="{{ $data->return_days }}" id="return_days" required>
                            @error('return_days')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Denda Keterlambatan</label>
                            <input type="number" class="form-control" name="denda" value="{{ $data->denda }}" id="denda" required>
                            @error('denda')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!-- Button untuk memunculkan modal konfirmasi -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="populateModal()">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Update -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="updateModalLabel">Konfirmasi Update</h5>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin mengupdate pengaturan dengan nilai baru berikut?</p>
                    <ul>
                        <li><strong>Maksimal Tanggal Pengembalian:</strong> <span id="updateReturnDays"></span> hari</li>
                        <li><strong>Denda Keterlambatan:</strong> <span id="updateDenda"></span></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <form id="updateForm" action="{{ route('librarian.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="return_days" id="modalReturnDays">
                        <input type="hidden" name="denda" id="modalDenda">
                        <button type="submit" class="btn btn-warning">Ya, Update</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sukses -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                </div>
                <div class="modal-body">
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
// Pastikan event berjalan setelah halaman sepenuhnya dimuat
document.addEventListener('DOMContentLoaded', function() {
    function populateModal() {
        var returnDays = document.getElementById('return_days').value;
        var denda = document.getElementById('denda').value;

        document.getElementById('updateReturnDays').textContent = returnDays;
        document.getElementById('updateDenda').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(denda);

        document.getElementById('modalReturnDays').value = returnDays;
        document.getElementById('modalDenda').value = denda;
    }

    document.querySelector('button[data-bs-toggle="modal"]').addEventListener('click', populateModal);
});
</script>

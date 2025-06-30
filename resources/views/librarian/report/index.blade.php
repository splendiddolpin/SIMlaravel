@extends("librarian.layouts.app")
@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="offset-md-4 col-md-4">
                    <h2 class="admin-heading text-center">Riwayat Peminjaman</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center">
                            <a href="{{ route('librarian.reports.date_wise') }}" class="card-link">
                                <h5 class="card-title mb-0">Riwayat Berdasarkan Tanggal</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center">
                            <a href="{{ route('librarian.reports.not_returned') }}" class="card-link">
                                <h5 class="card-title mb-0">Riwayat Keseluruhan</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center">
                            <a href="{{ route('librarian.reports.month_wise') }}" class="card-link">
                                <h5 class="card-title mb-0">Riwayat Berdasarkan Bulan</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

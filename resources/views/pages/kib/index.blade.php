@extends('layouts.app')

@section('title', '')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daftar Barang</h4>
                                <form action="{{ route('kib.upload') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group">
                                        <input type="file" name="file" class="form-control" accept=".xlsx" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-success">Upload</button>
                                        </div>
                                    </div>
                                </form> &nbsp;
                                <a href="{{ route('kib.export')}}" class="btn btn-warning">
                                    <i class="fas fa-file-excel"></i> Export
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari barang"
                                                name="name" value="{{ request('name') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Merk/Tipe</th>
                                            <th>Kode</th>
                                            <th>Harga Perolehan</th>
                                            <th>Kondisi</th>
                                            <th>Pemegang/Lokasi</th>
                                            <th>Tahun</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @foreach ($kibs as $kib)
                                            <tr>
                                                <td>{{ $kib->id }}</td>
                                                <td>{{ $kib->name }}</td>
                                                <td>{{ $kib->merk }}/{{ $kib->tipe }}</td>
                                                <td>{{ $kib->code }}</td>
                                                <td>{{ number_format($kib->price, '0', '.', '.') }}</td>
                                                <td>{{ $kib->condition }}</td>
                                                <td>{{ $kib->place }}</td>
                                                <td>{{ $kib->year }}</td>
                                                <td>
                                                    <a href="{{ route('kib.edit', $kib->id) }}" class="btn btn-sm"
                                                        title="Edit">
                                                        <i class="fa-solid fa-pencil"></i></a>
                                                    <a href="{{ route('kib.generate.qr', $kib->id) }}" class="btn btn-sm"
                                                        title="Generate QR Code">
                                                        <i class="fa-solid fa-barcode"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $kibs->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.selectric').selectric();
        });
    </script>
@endpush

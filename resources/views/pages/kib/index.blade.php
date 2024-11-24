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
                                <button type="button" class="btn btn-primary tambah-kib-btn" data-toggle="modal"
                                    data-target="#kibModal">
                                    Tambah Barang
                                </button>
                                <form action="{{ route('kib.upload') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group">
                                        <input type="file" name="file" class="form-control" accept=".xlsx" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-success">Upload</button>
                                        </div>
                                    </div>
                                </form>
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

    <div class="modal" id="kibModal" tabindex="-1" aria-labelledby="kibModalLabel" aria-hidden="true"
        data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kibModalLabel">Tambah Kartu Inventaris Barang (KIB)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kib.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="merk">Merk</label>
                                    <input type="text" name="merk" id="merk" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <label for="tipe">Tipe</label>
                                    <input type="text" name="tipe" id="tipe" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    <label for="jumlah_barang">Jumlah</label>
                                    <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" required>
                                </div>
                                <div class="col-8">
                                    <label for="harga_per_unit">Harga Perolehan / Unit</label>
                                    <input type="number" name="harga_per_unit" id="harga_per_unit" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="kondisi">Kondisi</label>
                                    <select name="kondisi" id="kondisi" class="form-control selectric">
                                        <option value="Baik">Baik</option>
                                        <option value="Rusak Ringan">Rusak Ringan</option>
                                        <option value="Rusak Berat">Rusak Berat</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="year">Tahun</label>
                                    <select name="year" id="year" class="form-control selectric">
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.selectric').selectric();

        });
    </script>
@endpush

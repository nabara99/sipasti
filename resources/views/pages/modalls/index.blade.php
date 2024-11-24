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
                                <h4>Daftar Belanja Modal</h4>
                            </div>
                            <div class="card-body">
                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>No SP2D</th>
                                            <th>Sub Kegiatan</th>
                                            <th>Rekening</th>
                                            <th>Uraian</th>
                                            <th>Nilai</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @php $displayedSpds = []; @endphp
                                        @foreach ($modals as $modal)
                                            @if (!in_array($modal->spd->no_spd, $displayedSpds))
                                                @php $displayedSpds[] = $modal->spd->no_spd; @endphp
                                                <tr>
                                                    <td>{{ $modal->spd->no_spd }}</td>
                                                    <td>{{ $modal->anggaran->sub->nama_sub ?? '-' }}</td>
                                                    <td>{{ $modal->anggaran->rekening->kode_rekening ?? '-' }}</td>
                                                    <td>{{ $modal->spd->spd_uraian ?? '-' }}</td>
                                                    <td>{{ number_format($modal->spd->spd_nilai, '0', '.', '.') }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-success tambah-kib-btn"
                                                            data-toggle="modal" data-target="#kibModal"
                                                            data-nama="{{ $modal->spd->spd_uraian ?? '-' }}"
                                                            data-harga="{{ $modal->spd->spd_nilai }}">
                                                            Tambah ke KIB
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $modals->withQueryString()->links() }}
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
        <div class="modal-dialog modal-xl">
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
                                    <input type="text" name="tipe" id="nama_barang" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-5">
                                    <label for="harga">Total Harga</label>
                                    <input type="text" name="harga" id="harga" class="form-control" required
                                        readonly>
                                </div>
                                <div class="col-3">
                                    <label for="jumlah_barang">Jumlah</label>
                                    <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control"
                                        required>
                                </div>
                                <div class="col-4">
                                    <label for="harga_per_unit">Harga per Unit</label>
                                    <input type="text" name="harga_per_unit" id="harga_per_unit" class="form-control"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="kode_barang">Kode Barang</label>
                                    <input type="text" name="kode_barang" id="kode_barang" class="form-control" required>
                                    <input type="hidden" name="year" id="year" class="form-control"
                                        value="2024" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="kondisi">Kondisi</label>
                                    <select name="kondisi" id="kondisi" class="form-control selectric" required>
                                        <option value="Baik">Baik</option>
                                        <option value="Rusak Ringan">Rusak Ringan</option>
                                        <option value="Rusak Berat">Rusak Berat</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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

            $('.tambah-kib-btn').on('click', function() {
                var namaBarang = $(this).data('nama');
                var harga = $(this).data('harga');

                $('#nama_barang').val(namaBarang);
                $('#harga').val(harga);
                $('#harga_per_unit').val('');
                $('#jumlah_barang').val('');
            });

            $('#jumlah_barang').on('input', function() {
                var totalHarga = parseFloat($('#harga').val()) || 0;
                var jumlahBarang = parseFloat($(this).val()) || 1;

                var hargaPerUnit = totalHarga / jumlahBarang;
                $('#harga_per_unit').val(hargaPerUnit.toFixed(0));
            });
        });
    </script>
@endpush

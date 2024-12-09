@extends('layouts.app')

@section('title', '')

@push('style')

@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
             <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-table"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Barang</h4>
                            </div>
                            <div class="card-body">
                                {{ $jumlah_barang }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-fire"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Kondisi Baik</h4>
                            </div>
                            <div class="card-body">
                                {{ $baik }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-car-burst"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Rusak Ringan</h4>
                            </div>
                            <div class="card-body">
                                {{ $rusak_ringan }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-explosion"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Rusak Berat</h4>
                            </div>
                            <div class="card-body">
                                {{ $rusak_berat }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


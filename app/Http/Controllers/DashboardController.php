<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_barang = DB::table('kibs')->count();
        $total_aset = DB::table('kibs')->sum('price');
        $baik = DB::table('kibs')->where('condition','Baik')->count();
        $rusak_ringan = DB::table('kibs')->where('condition','Rusak Ringan')->count();
        $rusak_berat = DB::table('kibs')->where('condition','Rusak Berat')->count();
        return view('dashboard', compact('jumlah_barang', 'total_aset', 'baik', 'rusak_ringan', 'rusak_berat'));
    }
}

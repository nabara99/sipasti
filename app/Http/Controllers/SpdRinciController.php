<?php

namespace App\Http\Controllers;

use App\Models\Spd;
use App\Models\SpdRinci;
use Illuminate\Http\Request;

class SpdRinciController extends Controller
{
    public function index(Request $request)
    {
        $modals = SpdRinci::with(['anggaran.sub', 'anggaran.rekening'])
            ->whereHas('anggaran.rekening', function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('kode_rekening', 'like', '5.2.02%')
                        ->orWhere('kode_rekening', 'like', '5.2.03%');
                });
            });

        $modals = $modals->paginate(10);

        return view('pages.modalls.index', compact('modals'));
    }

}

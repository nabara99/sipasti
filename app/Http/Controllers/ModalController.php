<?php

namespace App\Http\Controllers;

use App\Models\Kwitansi;
use App\Models\TempKwitansi;
use Illuminate\Http\Request;

class ModalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchHal = $request->input('hal');

        $modals = Kwitansi::with(['anggaran.sub', 'anggaran.rekening'])
        ->whereHas('anggaran.rekening', function ($query) {
            $query->where('kode_rekening', 'like', '5.2.02%');
        });

        if ($searchHal) {
            $modals->where('hal', 'like', '%' . $searchHal . '%');
        }

        $modals = $modals->paginate(10);

        return view('pages.modalgu.index', compact('modals', 'searchHal'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Kwitansi $kwitansi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kwitansi $kwitansi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kwitansi $kwitansi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kwitansi $kwitansi)
    {
        //
    }
}

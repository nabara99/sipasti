<?php

namespace App\Http\Controllers;

use App\Models\Kib;
use App\Http\Requests\UpdateKibRequest;
use App\Imports\KibsImport;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Maatwebsite\Excel\Facades\Excel;

class KibController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kibs = Kib::when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('pages.kib.index', compact('kibs'));
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
        $request->validate([
            'nama_barang' => 'required',
            'merk' => 'required',
            'tipe' => 'required',
            'jumlah_barang' => 'required|numeric',
            'harga_per_unit' => 'required|numeric',
            'kode_barang' => 'required',
            'kondisi' => 'required',
            'year' => 'required'
        ]);

        for ($i = 0; $i < $request->jumlah_barang; $i++) {
            $kib = new Kib();
            $kib->name = $request->nama_barang;
            $kib->merk = $request->merk;
            $kib->tipe = $request->tipe;
            $kib->price = $request->harga_per_unit;
            $kib->code = $request->kode_barang;
            $kib->condition = $request->kondisi;
            $kib->year = $request->year;

            $kib->save();
        }
        
        return redirect()->route('kib.index')->with('success', 'KIB baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kib $kib)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kib = Kib::findOrFail($id);

        return view('pages.kib.edit', compact('kib'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'merk' => 'required',
            'tipe' => 'required',
            'price' => 'required|numeric',
            'code' => 'required',
            'condition' => 'required',
            'place' => 'required',
            'year' => 'required'
        ]);

        $kib = Kib::findOrFail($id);
        $kib->update([
            'name' => $request->name,
            'merk' => $request->merk,
            'tipe' => $request->tipe,
            'price' => $request->price,
            'code' => $request->code,
            'condition' => $request->condition,
            'place' => $request->place,
            'year' => $request->year,
        ]);

        return redirect()->route('kib.index')->with('success', 'KIB berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kib $kib)
    {
        //
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx'
        ]);

        Excel::import(new KibsImport, $request->file('file'));
        return redirect()->back()->with('success', 'Data Kib berhasil diupload');
    }

    public function generateQrCode($id)
    {
        $kib = Kib::findOrFail($id);

        $qrData = "Nama Barang: {$kib->name}\n"
        . "Merk/Tipe: {$kib->merk}/{$kib->tipe}\n"
        . "Kode: {$kib->code}\n"
        . "Harga: Rp" . number_format($kib->price, 0, ',', '.') . "\n"
        . "Kondisi: {$kib->condition}\n"
        . "Lokasi: {$kib->place}\n"
        . "Tahun: {$kib->year}";

        $qrCode = new QrCode($qrData);

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        $fileName = "qr_code_{$kib->id}.png";

        return response($result->getString(), 200)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', "attachment; filename=\"{$fileName}\"");
    }

}

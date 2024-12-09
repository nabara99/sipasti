<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KibExport implements FromQuery, WithHeadings, WithMapping
{

    public function query()
    {
        return DB::table('kibs')
            ->select(
                'kibs.name',
                'kibs.merk',
                'kibs.tipe',
                'kibs.code',
                'kibs.price',
                'kibs.condition',
                'kibs.place',
                'kibs.year'
                )
            ->orderBy('id', 'asc');
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->merk,
            $row->tipe,
            $row->code,
            $row->price,
            $row->condition,
            $row->place,
            $row->year,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Barang',
            'Merk',
            'Tipe',
            'Kode Barang',
            'Harga Perolehan',
            'Kondisi',
            'Lokasi / Pemegang',
            'Tahun',
        ];
    }
}

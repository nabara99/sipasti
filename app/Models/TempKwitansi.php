<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempKwitansi extends Model
{
    use HasFactory;

    protected $table = 'temp_kwitansis';

    public function kwitansi()
    {
        return $this->belongsTo(Kwitansi::class);
    }

    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class);
    }
}

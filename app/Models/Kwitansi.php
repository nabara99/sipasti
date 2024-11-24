<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kwitansi extends Model
{
    use HasFactory;

    protected $table = 'kwitansis';
    protected $primaryKey = 'kw_id';

    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class);
    }
}

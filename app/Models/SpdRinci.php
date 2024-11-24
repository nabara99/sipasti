<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpdRinci extends Model
{
    use HasFactory;

    protected $table = 'spd_rincis';
    protected $primaryKey = 'id';

    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class);
    }

    public function spd()
    {
        return $this->belongsTo(Spd::class);
    }

}

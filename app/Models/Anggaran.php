<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    use HasFactory;

    protected $table = 'anggarans';

    public function sub()
    {
        return $this->belongsTo(Sub::class);
    }

    public function rekening()
    {
        return $this->belongsTo(Rekening::class);
    }
}

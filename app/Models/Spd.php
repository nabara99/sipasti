<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spd extends Model
{
    use HasFactory;

    protected $table = 'spds';
    protected $primaryKey = 'id';

    public function spdrinci()
    {
        return $this->hasMany(SpdRinci::class);
    }
}

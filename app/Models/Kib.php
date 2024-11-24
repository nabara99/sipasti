<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kib extends Model
{
    use HasFactory;

    protected $table = 'kibs';

    protected $fillable = [
        'name',
        'merk',
        'tipe',
        'price',
        'code',
        'condition',
        'place',
        'year',
    ];
}



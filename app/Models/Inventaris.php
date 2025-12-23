<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $table = 'inventaris';
    
    protected $fillable = [
        'nama',
        'kondisi',
        'jumlah',
        'tahun',
        'status',
        'status_val',
    ];

    protected $casts = [
        'kondisi' => 'integer',
        'jumlah' => 'integer',
        'tahun' => 'integer',
        'status_val' => 'float',
    ];
}
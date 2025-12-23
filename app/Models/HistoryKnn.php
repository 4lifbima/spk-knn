<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryKnn extends Model
{
    protected $table = 'history_knn';
    
    protected $fillable = [
        'user_id',
        'k_value',
        'input_kondisi',
        'input_jumlah',
        'result',
        'confidence',
        'neighbors',
    ];

    protected $casts = [
        'k_value' => 'integer',
        'input_kondisi' => 'integer',
        'input_jumlah' => 'integer',
        'confidence' => 'float',
        'neighbors' => 'array',
        'created_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'history_id',
        'evidence_id',
        'value',
    ];

    public function history()
    {
        return $this->belongsTo(History::class);
    }

    public function evidence()
    {
        return $this->belongsTo(Evidence::class);
    }
}

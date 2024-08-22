<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'hypothesis_id',
        'name',
        'description',
        'value',
        'result_treatment',
        'random_treatment',
        'patient_id',
        'created_by',
        'updated_by',
    ];

    public function hypothesis()
    {
        return $this->belongsTo(Hypothesis::class);
    }

    public function historyDetails()
    {
        return $this->hasMany(HistoryDetail::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dob',
        'gender',
        'age',
        'weight',
        'address',
        'phone_number',
        'occupation',
        'user_id',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = $value;
        $this->attributes['age'] = now()->diffInYears($value);
    }
    public function histories()
    {
        return $this->hasMany(History::class);
    }
}

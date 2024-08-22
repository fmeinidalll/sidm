<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hypothesis extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'code',
        'name',
        'description',
        'solution'
    ];

    public function history(){
        return $this->hasMany(History::class);
    }

    public function role(){
        return $this->hasMany(Role::class);
    }
    
}

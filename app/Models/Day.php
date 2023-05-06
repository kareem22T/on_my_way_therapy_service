<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];

    public function doctors()
    {
        return $this->belongsToMany('App\Models\Doctor', 'holidays_doctor', 'day_id', 'doctor_id', 'id', 'id');
    }
}

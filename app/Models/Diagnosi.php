<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosi extends Model
{
    use HasFactory;

    protected $table = 'diagnosis';

    protected $fillable = [
        'id',
        'name',
    ];

    public  $timestamps = false;

    // relationships ......
    public function doctors()
    {
        return $this->belongsToMany('App\Models\Doctor', 'doctor_diagnosis', 'diagnosis_id', 'doctor_id', 'id', 'id');
    }
}

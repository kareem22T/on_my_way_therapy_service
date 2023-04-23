<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client_age_range extends Model
{
    use HasFactory;
    protected $table = 'client_age_ranges';

    protected $fillable = [
        'id',
        'range',
    ];

    public  $timestamps = false;

    // relationships ......
    public function doctors()
    {
        return $this->belongsToMany('App\Models\Doctor', 'doctor_client_age_range', 'client_age_range_id', 'doctor_id', 'id', 'id');
    }
}

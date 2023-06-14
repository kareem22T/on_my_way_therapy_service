<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Therapist_rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'rating',
        'review',
        'doctor_id',
        'client_id',
    ];

    public $timestamps = false;

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor', 'doctor_id');
    }
    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'doctor_id',
        'client_id',
        'date',
        'start_time',
        'finish_time',
        'comments',
        'visit_type',
        'status',
        'address',
        'address_lat',
        'address_lng',
        'journey'
    ];

    public $timestamps = false;


    // relationship --
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor', 'doctor_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }

    // getters and setters
    public function getStatusAttribute($value)
    {
        if ($value == 0) {
            return 'pending';
        } else if ($value == 1) {
            return 'approved';
        } else if ($value == 2) {
            return 'edited';
        } else if ($value == 3) {
            return 'Cancelled';
        }
        return null;
    }
}
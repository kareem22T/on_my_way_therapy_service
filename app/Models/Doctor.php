<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'photo',
        'phone_key',
        'phone',
        'email',
        'address',
        'password',
        'dob',
        'gender',
        'verified',
        'profession_id',
        'client_gender',
        'experience',
        'client_diagnosis',
        'WWCC_path',
        'AHPRA_path',
        'NDIS_path',
        'about_me',
        'client_age_range',
        'travel_range',
        'visits',
        'information_registered',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password',
    ];

    protected  $guard  = "doctor";
}

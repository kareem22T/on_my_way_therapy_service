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
        'photo',
        'first_name',
        'last_name',
        'phone_key',
        'phone',
        'gender',
        'email',
        'address',
        'password',
        'about_me',
    ];

    protected $hidden = [
        'password',
    ];

    protected  $guard  = "doctor";
}

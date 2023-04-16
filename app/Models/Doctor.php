<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fiellable = [
        'id',
        'photo',
        'name',
        'phone_key',
        'phone',
        'email',
        'address',
        'password',
        'confirm_password',
        'about_me',
    ];

    protected $hidden = [
        'password',
    ];

    protected  $guard  = "doctor";
}

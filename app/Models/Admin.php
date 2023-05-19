<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'id',
        'username',
        'name',
        'password',
    ];

    public $timestamps = false;

    protected $hidden = [
        'password',
    ];

    protected  $guard  = "admin";
}
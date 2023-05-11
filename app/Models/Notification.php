<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'receiver_id',
        'receiver_guard_type',
        'content',
        'created_at',
        'updated_at',
    ];
}

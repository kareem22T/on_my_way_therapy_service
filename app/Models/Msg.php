<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'chat_id',
        'sender_guard',
        'msg_data',
        'seen',
        'delivered',
        'created_at',
        'updated_at'
    ];

    // relationships
    public function chat()
    {
        return $this->belongsTo('App\Models\Chat', 'chat_id');
    }
}

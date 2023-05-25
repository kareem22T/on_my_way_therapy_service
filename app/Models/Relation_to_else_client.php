<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation_to_else_client extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'relation',
    ];

    public $timestams = false;

    //relationships
    public function clients()
    {
        return $this->hasMany('App\Models\Client', 'relation_to_else_client_id');
    }
}

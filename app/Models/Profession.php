<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;
    protected $table = 'professions';

    protected $fillable = [
        'id',
        'title',
    ];

    public  $timestamps = false;

    // relationships ......
    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor', 'profession_id');
    }
}

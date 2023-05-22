<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'id',
        'account_type',
        'photo',
        'first_name',
        'last_name',
        'phone',
        'phone_key',
        'email',
        'password',
        'dob',
        'address',
        'address_lat',
        'address_lng',
        'gender',
        'company_name',
        'company_email',
        'therapist_gender',
        'session_type',
        'client_type',
        'managment_type',
        'agreed_on_policy',
        'card_number',
        'name_on_card',
        'expiration_date',
        'security_code',
        'verified',
        'relation_to_patient',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
    ];

    protected  $guard  = "client";

    // realations 
    public function diagnosis()
    {
        return $this->belongsToMany('App\Models\Diagnosi', 'client_diagnosis', 'client_id', 'diagnosis_id', 'id', 'id');
    }

    // public function chats()
    // {
    //     return $this->hasMany('App\Models\Chat', 'client_id');
    // }
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment', 'client_id');
    }

    // getters and setters
    public function getGenderAttribute($value)
    {
        if ($value == 0) {
            return 'male';
        } else if ($value == 1) {
            return 'female';
        }
        return null;
    }
}

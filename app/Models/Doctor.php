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
        'address_lat',
        'address_lng',
        'password',
        'dob',
        'gender',
        'verified',
        'password_set',
        'profession_id',
        'client_gender',
        'experience',
        'client_diagnosis',
        'WWCC_number',
        'AHPRA_number',
        'SPA_number',
        'practitioner_number',
        'NDIS_number',
        'about_me',
        'client_age_range',
        'travel_range',
        'visits',
        'working_hours_from',
        'working_hours_to',
        'information_registered',
        'name_payment',
        'BSB_payment',
        'account_payment',
        'ABN_payment',
        'agreed_on_policy',
        'payment_registered',
        'approved',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password',
    ];

    protected  $guard  = "doctor";

    // relationships ....

    public function profession()
    {
        return $this->belongsTo('App\Models\Profession', 'profession_id');
    }

    public function diagnosis()
    {
        return $this->belongsToMany('App\Models\Diagnosi', 'doctor_diagnosis', 'doctor_id', 'diagnosis_id', 'id', 'id');
    }

    public function ClientAgeRange()
    {
        return $this->belongsToMany('App\Models\Client_age_range', 'doctor_client_age_range', 'doctor_id', 'client_age_range_id', 'id', 'id');
    }

    public function chats()
    {
        return $this->hasMany('App\Models\Chat', 'doctor_id');
    }

    public function rating()
    {
        return $this->hasMany('App\Models\Therapist_rating', 'doctor_id');
    }
    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment', 'doctor_id');
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
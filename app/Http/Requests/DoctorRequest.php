<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class DoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'photo' => ['required', 'mimes:jpeg,png,gif,jpg'],
            'first_name' => ['required', 'alpha', 'regex:/^[^\s\d]+$/'],
            'last_name' => ['required', 'alpha', 'regex:/^[^\s\d]+$/'],
            'phone' => 'required|regex:/^[0-9]{7,}$/|unique:doctors',
            'email' => 'required|email|unique:doctors',
            'address' => 'required',
            'gender' => 'required',
            'dob' => 'required|date_format:Y-m-d',
            'phone_code' => 'required_if:phone_code,',
            'email_code' => 'required_if:email_code,',
        ];
    }

    public function messages(): array
    {
        return [
            'photo.required' => 'Please upload your photo.',
            'photo.mimes' => 'Invalid file type. Please choose a GIF, JPEG, jpg, or PNG image.',
            'frist_name.required' => 'Please enter your first name.',
            'first_name.alpha' => 'Your first name must contain letters only and have no spaces.',
            'last_name.alpha' => 'Your last name must contain letters only and have no spaces.',
            'last_name.required' => 'Please enter your last name.',
            'first_name.regex' => 'Your first name must be at between 10-255 characters with no special characters or numbers.',
            'email.required' => 'Please enter your valid email address.',
            'email.unique' => 'This email address is already registered.',
            'dob.required' => 'Please enter your bridth date.',
            'dob.date_format' => 'Please enter your bridth date.',
            'gender.required' => 'please choose a gender.',
            'last_name.regex' => 'Your last name must be at between 10-255 characters with no special characters or numbers.',
            'phone.required' => 'please enter a valid phone number',
            'phone.regex' => 'Please enter a valid phone number without the country code',
            'phone.unique' => 'This number is already registered',
            'address.required' => 'please enter your address or enable location access',
            'about.required' => 'Please enter short description about you',
            'phone_code.required_if' => 'Please enter the phone verfication code.',
            'email_code.required_if' => 'Please enter the email verfication code.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->input('phone_code') && $this->input('email_code')) :
                if (!Hash::check($this->input('phone_code'), $this->input('correct_phone_code'))) {
                    $validator->errors()->add('phone_code', 'The phone verfication code is not corect');
                }
                if (!Hash::check($this->input('email_code'), $this->input('correct_email_code'))) {
                    $validator->errors()->add('email_code', 'The email verfication code is not corect');
                }
                if ($this->input('remainingTime') >= 360000) {
                    $validator->errors()->add('email_code', 'your verfication code has expired click resend to send new codes');
                }
            endif;
        });
    }
}

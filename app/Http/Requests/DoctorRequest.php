<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
            'first_name' => ['required', 'alpha', 'regex:/^[^\s\d]+$/'],
            'last_name' => ['required', 'alpha', 'regex:/^[^\s\d]+$/'],
            'phone' => 'required|regex:/^[0-9]{7,}$/|unique:doctors',
            'email' => 'required|email|unique:doctors',
            'address' => 'required',
            'gender' => 'required',
            'dob' => 'required|date_format:Y-m-d',
            // 'password_confirmation' => 'required',
            // 'password' => [
            //     'required',
            //     'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/',
            //     'confirmed',
            // ],
            // 'about' => 'required|min:100|max:255',
        ];
    }

    public function messages(): array
    {
        return [
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
            // 'password.required' => 'please enter a password containing upper and lower case characters mixed with number and special characters (ex: Abcd123@@@)',
            // 'password.regex' => 'please enter a password containing upper and lower case characters mixed with number and special characters (ex: Abcd123@@@)',
            // 'password.confirmed' => 'the password you entered and its confirmation are not matching',
            'address.required' => 'please enter your address or enable location access',
            'about.required' => 'Please enter short description about you',
            // 'about.min' => 'Please enter a description at least 100 characters',
            // 'about.max' => 'Please enter a description not more than 255 characters',
        ];
    }
}

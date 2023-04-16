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
            'name' => 'required|regex:/^[A-Za-z ]{10,255}$/',
            'phone' => 'required|regex:/^[0-9]{7,}$/',
            'email' => 'required|email',
            'address' => 'required',
            'password_confirmation' => 'required',
            'password' => [
                'required',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/',
                'confirmed',
            ],
            'about' => 'required|min:100|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Your Name is required',
            'name.regex' => 'Your Name must be at between 10-255 characters with no special characters or numbers.',
            'phone.required' => 'please enter a valid phone number',
            'phone.regex' => 'Please enter a valid phone number without the country code',
            'password.required' => 'please enter a password containing upper and lower case characters mixed with number and special characters (ex: Abcd123@@@)',
            'password.regex' => 'please enter a password containing upper and lower case characters mixed with number and special characters (ex: Abcd123@@@)',
            'password.confirmed' => 'the password you entered and its confirmation are not matching',
            'address.required' => 'please enter your address or enable location access',
            'about.required' => 'Please enter short description about you',
            'about.min' => 'Please enter a description at least 100 characters',
            'about.max' => 'Please enter a description not more than 255 characters',
        ];
    }
}

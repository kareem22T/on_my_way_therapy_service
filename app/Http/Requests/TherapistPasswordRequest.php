<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class TherapistPasswordRequest extends FormRequest
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
            'password_confirmation' => 'required',
            'password' => [
                'required',
                'regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!$#%@_.,?*+=\-:;~]).{8,}$/',
                'confirmed',
                'min:8'
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'password.required' => 'please enter password containing at least 8 characters, one uppercase, number and special character',
            'password.regex' => 'please enter password containing at least 8 characters, one uppercase, number and special character',
            'password.confirmed' => 'the password you entered and its confirmation are not matching',
        ];
    }
}
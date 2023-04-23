<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class TherapistVerficationRequest extends FormRequest
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
            'phone_code' => 'required',
            'email_code' => 'required',
            'password_confirmation' => 'required',
            'password' => [
                'required',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/',
                'confirmed',
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'phone_code.required' => 'Please enter the phone verfication code.',
            'email_code.required' => 'Please enter the email verfication code.',
            'password.required' => 'please enter a password containing upper and lower case characters mixed with number and special characters (ex: Abcd123@@@)',
            'password.regex' => 'please enter a password containing upper and lower case characters mixed with number and special characters (ex: Abcd123@@@)',
            'password.confirmed' => 'the password you entered and its confirmation are not matching',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!Hash::check($this->input('phone_code'), $this->input('correct_phone_code'))) {
                $validator->errors()->add('phone_code', 'The phone verfication code is not corect');
            }
            if (!Hash::check($this->input('email_code'), $this->input('correct_email_code'))) {
                $validator->errors()->add('email_code', 'The email verfication code is not corect');
            }
            if ($this->input('remainingTime') >= 360000) {
                $validator->errors()->add('email_code', 'your verfication code has expired click resend to send new codes');
            }
        });
    }
}

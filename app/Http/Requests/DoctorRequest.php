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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:10|max:255|regex:/^[A-Za-z\s-_]+$/',
            'phone' => 'required|regex:/^[0-9]{7,}$/',
            'email' => 'required|email',
            'address' => 'required',
            'password' => [
                'required', 'confirmed:confirm_password', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'about' => 'required|min:100|max:255'

        ];
    }

    public function messages(): array
    {
        return [
            //
        ];
    }
}

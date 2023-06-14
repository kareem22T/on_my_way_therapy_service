<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TherapistPaymentRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'BSB' => ['required', 'digits:6', 'regex:/^[0-9]{6,}$/'],
            'bank_account' => ['required', 'string'],
            'ABN' => ['required', 'digits:11', 'regex:/^[0-9]{11,}$/'],
            'agree' => ['required']
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your name',
            'name.regex' => 'Please enter your real name at your ID',
            'BSB.required' => 'Please enter your bank account BSB 6 digits number',
            'BSB.digits' => 'Please enter your bank account BSB 6 digits number',
            'BSB.regex' => 'Please enter your bank account BSB 6 digits number',
            'banck_account.required' => 'Please enter your bank account.',
            'bank_account.string' => 'Please enter your bank account',
            'ABN.required' => 'Please enter your bank account ABN 11 digits number',
            'ABN.digits' => 'Please enter your bank account ABN 11 digits number',
            'ABN.regex' => 'Please enter your bank account ABN 11 digits number',
            'agree.required' => 'Please agree on the terms and policies'
        ];
    }
}

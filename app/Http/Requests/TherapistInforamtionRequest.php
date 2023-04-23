<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TherapistInforamtionRequest extends FormRequest
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
            'profession' => ['required', 'max:120'],
            'client_gender' => 'required',
            'experience' => ['required', 'numeric', 'digits_between:11,2'],
            'diagnosis' => ['required', 'array', 'min:1'],
            'WWCC' => ['required', 'mimes:jpeg,png,pdf', 'max:2048'],
            'AHPRA' => ['required', 'mimes:jpeg,png,pdf', 'max:2048'],
            'NDIS' => ['required', 'mimes:jpeg,png,pdf', 'max:2048'],
            'about' => 'required|min:100|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'about.min' => 'Please enter a description at least 100 characters',
            'about.max' => 'Please enter a description not more than 255 characters',
        ];
    }
}

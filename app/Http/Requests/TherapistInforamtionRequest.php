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
            'profession'        => ['required'],
            'client_gender'     => 'required',
            'experience'        => ['required', 'numeric', 'digits_between:1,2'],
            'diagnosis'         => ['required', 'array', 'min:1'],
            'WWCC'              => ['required', 'mimes:jpeg,png,pdf', 'max:2048'],
            'AHPRA'             => ['required', 'mimes:jpeg,png,pdf', 'max:2048'],
            'NDIS'              => ['required', 'mimes:jpeg,png,pdf,jpg', 'max:2048'],
            'about_me'             => ['required', 'min:100', 'max:255'],
            'client_age_range'  => ['required', 'array', 'min:1'],

        ];
    }

    public function messages(): array
    {
        return [
            'profession.required' => 'Please choose your profession.',
            'client_gender.required' => 'Please choose your prefered your clients gender.',
            'experience.required' => 'Please choose enter your experience years number.',
            'experience.numeric' => 'Please enter your experience years with out characters, just number.',
            'experience.digits_between' => 'Please enter a valid experience number',
            'diagnosis.required' => 'Please enter at least one diagnosis.',
            'WWCC.required' => 'Please upload your WWCC certificate.',
            'WWCC.mimes' => 'Please upload WWCC certificate with type jpg, jpg, png or pdf file',
            'WWCC.max' => 'Please upload WWCC certificate with max size 2mb.',
            'AHPRA.required' => 'Please upload your AHPRA certificate.',
            'AHPRA.mimes' => 'Please upload AHPRA certificate with type jpg, jpg, png or pdf file',
            'AHPRA.max' => 'Please upload AHPRA certificate with max size 2mb.',
            'NDIS.required' => 'Please upload your NDIS certificate.',
            'NDIS.mimes' => 'Please upload NDIS certificate with type jpg, jpg, png or pdf file',
            'NDIS.max' => 'Please upload NDIS certificate with max size 2mb.',
            'about_me.min' => 'Please enter a description at least 100 characters',
            'about_me.min' => 'Please enter a description at least 100 characters',
            'about_me.max' => 'Please enter a description not more than 255 characters',
        ];
    }
}

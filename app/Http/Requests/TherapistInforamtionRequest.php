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
            'WWCC'              => ['required'],
            'AHPRA'             => ['required_if:profession,1,3,4,6,7'],
            'SPA'               => ['required_if:profession,2'],
            'practitioner_number'   => ['required_if:profession,5'],
            'NDIS'              => ['required'],
            'about_me'          => ['required', 'min:100', 'max:255'],
            'client_age_range'  => ['required', 'array', 'min:1'],
            'visits_type' => ['required', 'array', 'min:1'],
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
            'WWCC.required' => 'Please enter your WWCC number.',
            'AHPRA.required_if' => 'Please enter your AHPRA number.',
            'SPA.required_if' => 'Please enter your SPA number.',
            'practitioner_number.required_if' => 'Please write your practitioner number.',
            'NDIS.required' => 'Please enter your NDIS number.',
            'about_me.min' => 'Please enter a description at least 100 characters',
            'about_me.min' => 'Please enter a description at least 100 characters',
            'about_me.max' => 'Please enter a description not more than 255 characters',
            'visits_type.required' => 'Please select a session type',
        ];
    }
}

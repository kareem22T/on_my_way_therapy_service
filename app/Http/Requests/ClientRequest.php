<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'photo' => ['mimes:jpeg,png,gif,jpg'],
            'first_name' => ['required', 'alpha', 'regex:/^[^\s\d]+$/'],
            'last_name' => ['required', 'alpha', 'regex:/^[^\s\d]+$/'],
            'phone' => 'required|regex:/^[0-9]{7,}$/|unique:clients',
            'email' => 'required|email|unique:clients',
            'address' => 'required',
            'address_lat' => 'required',
            'address_lng' => 'required',
            'gender' => 'required',
            'dob' => 'required|date_format:Y-m-d',
            'password_confirmation' => 'required',
            'password' => [
                'required',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/',
                'confirmed',
            ],
            'company_name' => 'requird_if:account_type,1|max:100',
            'company_email' => 'requird_if:account_type,1|nullable|email',
            'relation_to_patient' => 'requird_if:account_type,1',
            'therapist_gender' => 'required',
            'session_type' => ['required'],
            'client_type' => 'required',
            'NDIS_number' => 'required_if:client_type,1',
            'NDIS_end_date' => 'required_if:client_type,1',
            'plan_managment' => 'required',
            'manager_email' => 'required_if:client_type,1',
            'card_number' => 'required_if:plan_managment,0',
        ];
    }

    public function messages(): array
    {
        return [
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
            'password.regex' => 'please enter a password containing upper and lower case characters mixed with number and special characters (ex: Abcd123@@@)',
            'password.confirmed' => 'the password you entered and its confirmation are not matching',
            'company_email.email' => 'Please enter a valid company email address',
            'therapist_gender.required' => 'Please choose your preferred therapist gender.',
            'session_type.required' => 'Please select a session type',
            'client_type.required' => 'Please choose a client type',
            'NDIS_number.required_if' => 'Please enter the NDIS number',
            'NDIS_end_date.required_if' => 'Please select the NDIS end date',
            'manager_email.required_if' => 'Please enter the manager email',
            'card_number.required_if' => 'Please enter the card number',
        ];
    }
}

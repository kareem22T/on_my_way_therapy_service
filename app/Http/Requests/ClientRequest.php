<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

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
                'regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!$#%@_.,?*+=\-:;~]).{8,}$/',
                'confirmed',
                'min:8'
            ],
            'company_name' => 'max:100',
            'company_email' => 'nullable|email',
            'relation_to_patient' => 'required_if:account_type,1',
            'session_type' => ['required'],
            'client_type' => 'required_if:account_type,0',
            'phone_code' => 'required_if:phone_code,',
            'email_code' => 'required_if:email_code,',
            'services' => ['required', 'array', 'min:1'],
            'services.*' => ['numeric'],
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
            'first_name.regex' => 'Your first name must be at between 10-255 char with no special char or numbers.',
            'email.required' => 'Please enter your valid email address.',
            'email.unique' => 'This email address is already registered.',
            'dob.required' => 'Please enter your bridth date.',
            'dob.date_format' => 'Please enter your bridth date.',
            'gender.required' => 'please choose a gender.',
            'last_name.regex' => 'Your last name must be at between 10-255 char with no special char or numbers.',
            'phone.required' => 'please enter a valid phone number',
            'phone.regex' => 'Please enter a valid phone number without the country code',
            'phone.unique' => 'This number is already registered',
            'address.required' => 'please enter your address or enable location access',
            'password.regex' => 'please enter a password from at least 8 char containing upper and lower case char mixed with number and special char (ex: Abcd123@@@)',
            'password.confirmed' => 'the password you entered and its confirmation are not matching',
            'company_email.email' => 'Please enter a valid company email address',
            'session_type.required' => 'Please select a session type',
            'client_type.required' => 'Please choose a client type',
            'NDIS_number.required_if' => 'Please enter the NDIS number',
            'NDIS_end_date.required_if' => 'Please select the NDIS end date',
            'manager_email.required_if' => 'Please enter the manager email address',
            'card_number.required_if' => 'Please enter the credit card number',
            'name_on_card.required_if' => 'Please enter your name as it is on the card',
            'expiration_date.required_if' => 'Please enter card expiration date',
            'security_code.required_if' => 'Please enter card expiration security code',
            'relation_to_patient.required_if' => 'Please select your relation to client',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->input('correct_email_code') && $this->input('email_code') == '') {
                $validator->errors()->add('email_code', 'Please enter the phone validation code');
            }
            if ($this->input('phone_code') && $this->input('email_code')) :
                if ($this->input('email_code') !== $this->input('correct_email_code')) {
                    $validator->errors()->add('email_code', 'The email verfication code is not corect');
                }
                if ($this->input('remainingTime') >= 360000) {
                    $validator->errors()->add('email_code', 'your verfication code has expired click resend to send new codes');
                }
            endif;
            if ($this->input('client_type') == 1 && $this->input('managment_type') == 1 && $this->input('manager_email') == '' && $this->input('account_type') == 0) :
                $validator->errors()->add('managment_email', 'Please enter the manager email address');
            endif;
            if ($this->input('NDIS_number') == '' && $this->input('client_type') == 1 && $this->input('account_type') == 0) :
                $validator->errors()->add('NDIS_number', 'Please enter the NDIS number');
            endif;
            if ($this->input('NDIS_end_date') == '' && $this->input('client_type') == 1 && $this->input('account_type') == 0) :
                $validator->errors()->add('NDIS_end_date', 'Please enter the NDIS end date');
            endif;
            if ($this->input('card_number') == '' && ($this->input('client_type') == 0 || $this->input('managment_type') == 2) && $this->input('account_type') == 0) :
                $validator->errors()->add('card_number', 'Please enter your cridit card number');
            endif;
            if ($this->input('name_on_card') == '' && ($this->input('client_type') == 0 || $this->input('managment_type') == 2) && $this->input('account_type') == 0) :
                $validator->errors()->add('name_on_card', 'Please enter your name on the card');
            endif;
            if ($this->input('expiration_date') == '' && ($this->input('client_type') == 0 || $this->input('managment_type') == 2) && $this->input('account_type') == 0) :
                $validator->errors()->add('expiration_date', 'Please enter credit card expiration date');
            endif;
            if ($this->input('security_code') == '' && ($this->input('client_type') == 0 || $this->input('managment_type') == 2) && $this->input('account_type') == 0) :
                $validator->errors()->add('security_code', 'Please enter credit card security code');
            endif;
            if ($this->input('managed_clients'))
                foreach ($this->input('managed_clients') as $index => $managed_client) :
                    if (json_decode($managed_client)->first_name == '')
                        $validator->errors()->add('client' . ' ' . ($index + 1) . '_first_name', 'Please enter ' . 'client' . ' ' . ($index + 1) . ' first name');
                    if (preg_match('/^[a-zA-Z\-\'\s]+$/u', json_decode($managed_client)->first_name))
                        $validator->errors()->add('client' . ' ' . ($index + 1) . '_first_name', 'Please enter valid first name for' . 'client' . $index);
                    if (json_decode($managed_client)->last_name == '')
                        $validator->errors()->add('client' . ' ' . ($index + 1) . '_last_name', 'Please enter ' . 'client' . ' ' . ($index + 1) . ' last name');
                    if (preg_match('/^[a-zA-Z\-\'\s]+$/u', json_decode($managed_client)->last_name))
                        $validator->errors()->add('client' . ' ' . ($index + 1) . '_last_name', 'Please enter valid first name for' . 'client' . $index);
                    if (json_decode($managed_client)->dob == '')
                        $validator->errors()->add('client' . ' ' . ($index + 1) . '_dob', 'Please enter ' . 'client' . ' ' . ($index + 1) . ' Date of brith');
                    if (json_decode($managed_client)->gender == '')
                        $validator->errors()->add('client' . ' ' . ($index + 1) . '_gender', 'Please select ' . 'client' . ' ' . ($index + 1) . ' gender');
                    if (json_decode($managed_client)->client_type == 1 && json_decode($managed_client)->managment_type == 1 && json_decode($managed_client)->manager_email == '') :
                        $validator->errors()->add('client' . ' ' . ($index + 1) . '_managment_email', 'Please enter the manager email address of ' . 'client' . ' ' . ($index + 1));
                    endif;
                    if (json_decode($managed_client)->NDIS_number == '' && json_decode($managed_client)->client_type == 1) :
                        $validator->errors()->add('client' . ' ' . ($index + 1) . '_NDIS_number', 'Please enter ' . 'client' . ' ' . ($index + 1) . ' NDIS number');
                    endif;
                    if (json_decode($managed_client)->NDIS_end_date == '' && json_decode($managed_client)->client_type == 1) :
                        $validator->errors()->add('client' . ' ' . ($index + 1) . '_NDIS_end_date', 'Please enter ' . 'client' . ' ' . ($index + 1) . ' NDIS end date');
                    endif;
                    if (isset(json_decode($managed_client)->card_number))
                        if (json_decode($managed_client)->card_number == '' && (json_decode($managed_client)->client_type == 0 || json_decode($managed_client)->managment_type == 2)) :
                            $validator->errors()->add('client' . ' ' . ($index + 1) . '_card_number', 'Please enter ' . 'client' . ' ' . ($index + 1) . ' cridit card number');
                        endif;
                    if (isset(json_decode($managed_client)->name_on_card))
                        if (json_decode($managed_client)->name_on_card == '' && (json_decode($managed_client)->client_type == 0 || json_decode($managed_client)->managment_type == 2)) :
                            $validator->errors()->add('client' . ' ' . ($index + 1) . '_name_on_card', 'Please enter ' . 'client' . ' ' . ($index + 1) . ' name on the card');
                        endif;
                    if (isset(json_decode($managed_client)->expiration_date))
                        if (json_decode($managed_client)->expiration_date == '' && (json_decode($managed_client)->client_type == 0 || json_decode($managed_client)->managment_type == 2)) :
                            $validator->errors()->add('client' . ' ' . ($index + 1) . '_expiration_date', 'Please enter ' . 'client' . ' ' . ($index + 1) . ' credit card expiration date');
                        endif;
                    if (isset(json_decode($managed_client)->security_code))
                        if (json_decode($managed_client)->security_code == '' && (json_decode($managed_client)->client_type == 0 || json_decode($managed_client)->managment_type == 2)) :
                            $validator->errors()->add('client' . ' ' . ($index + 1) . '_security_code', 'Please enter ' . 'client' . ' ' . ($index + 1) . ' credit card security code');
                        endif;
                endforeach;
        });
    }
}

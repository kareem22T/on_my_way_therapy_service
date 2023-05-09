<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HostAppointmentRequest extends FormRequest
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
            'date' => 'required',
            'visit_type' => 'required',
            'address' => 'required_if:visit_type,0',
            'address_lat' => 'required_if:visit_type,0',
            'address_lng' => 'required_if:visit_type,0',
        ];
    }
}

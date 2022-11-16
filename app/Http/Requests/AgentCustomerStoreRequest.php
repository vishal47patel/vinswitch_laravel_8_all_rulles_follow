<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AgentCustomerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'contact_no' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'First name cannot be blank.',
            'lastname.required' => 'Last name cannot be blank.',
            'email.required' => 'Email cannot be blank.',
            'contact_no.required' => 'Phone no cannot be blank.',
            'company_name.required' => 'Company name cannot be blank.',
            'address.required' => 'Address cannot be blank.',
            'state.required' => 'State cannot be blank.',
            'city.required' => 'City cannot be blank.',
            'postal_code.required' => 'Zipcode cannot be blank.',
        ];
    }
}

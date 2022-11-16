<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantCustomerStoreRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
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
            'first_name.required' => 'First name cannot be blank.',
            'last_name.required' => 'Last name cannot be blank.',
            'email.required' => 'Email cannot be blank.',
            'phone_number.required' => 'Phone no cannot be blank.',
            'company_name.required' => 'Company name cannot be blank.',
            'address.required' => 'Address cannot be blank.',
            'state.required' => 'State cannot be blank.',
            'city.required' => 'City cannot be blank.',
            'postal_code.required' => 'Zipcode cannot be blank.',
        ];
    }
}

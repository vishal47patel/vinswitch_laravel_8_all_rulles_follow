<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantAccountStoreRequest extends FormRequest
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
            'username' => 'required|unique:user,username',
            'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[@!$#%]).*$/',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First name cannot be blank.',
            'last_name.required' => 'Last name cannot be blank.',
            'email.required' => 'Email cannot be blank.',
            'phone_number.required' => 'Phone no cannot be blank.',
            'username.required' => 'Company name cannot be blank.',
            'password.required' => 'Address cannot be blank.',
            'password.regex' => 'Password must contain upper and lower case letters and at least 1 number and special characters, such as @, #, $.',
            'password.min' =>  'Passwords must be at least 8 characters.',
            'username.unique' => 'Username should be unique.',
        ];
    }
}

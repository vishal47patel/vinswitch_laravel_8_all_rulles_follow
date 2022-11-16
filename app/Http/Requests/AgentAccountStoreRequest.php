<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentAccountStoreRequest extends FormRequest
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
            'phoneno' => 'required',
            'username' => 'required',
            'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[@!$#%]).*$/',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'First name cannot be blank.',
            'lastname.required' => 'Last name cannot be blank.',
            'email.required' => 'Email cannot be blank.',
            'phoneno.required' => 'Phone no cannot be blank.',
            'username.required' => 'Company name cannot be blank.',
            'password.required' => 'Address cannot be blank.',
            'password.regex' => 'Password must contain upper and lower case letters and at least 1 number and special characters, such as @, #, $.',
            'password.min' =>  'Passwords must be at least 8 characters.',
        ];
    }
}

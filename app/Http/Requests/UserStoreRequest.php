<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'role_id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:user,email',
            'phoneno' => 'required|unique:user,phoneno',
            'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[@!$#%]).*$/',
            'confirm_password' => 'required_with:password|same:password|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[@!$#%]).*$/',
            'username' => 'required',
            'status' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => 'Role cannot be blank.',
            'firstname.required' => 'First name cannot be blank.',
            'lastname.required' => 'Last name cannot be blank.',
            'email.required' => 'Email cannot be blank.',
            'phoneno.required' => 'Phone no cannot be blank.',
            'password.required' => 'Password cannot be blank.',
            'email.unique' => 'Email should be unique.',
            'phoneno.unique' => 'Phone should be unique.',
            'username.required' => 'Username cannot be blank.',
            'status.required' => 'Status cannot be blank.',
            'confirm_password.regex' => 'Password must contain upper and lower case letters and at least 1 number and special characters, such as @, #, $.',
            'confirm_password.same' => 'Password does not match.',
            'password.regex' => 'Password must contain upper and lower case letters and at least 1 number and special characters, such as @, #, $.',
            'password.min' =>  'Passwords must be at least 8 characters.',
            'confirm_password.min' =>  'Passwords must be at least 8 characters.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => 'required|unique:user,email,'.$this->id,
            'phoneno' => 'required|unique:user,phoneno,'.$this->id,
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
            'email.unique' => 'Email should be unique.',
            'phoneno.unique' => 'Phone should be unique.',
            'username.required' => 'Username cannot be blank.',
            'status.required' => 'Status cannot be blank.',
        ];
    }
}

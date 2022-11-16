<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentResetPasswordRequest extends FormRequest
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
            'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[@!$#%]).*$/',
            'confirm_password' => 'required|same:password|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[@!$#%]).*$/'
        ];
    }
    public function messages()
    {
        return [
            'password.min' =>  'Passwords must be at least 8 characters.',
            'password.required' => 'Please enter password.',
            'confirm_password.same' => 'Password does not match.',
            'confirm_password.required' => 'Please enter confirm password.',
            'confirm_password.min' =>  'Passwords must be at least 8 characters.',
            'confirm_password.regex' => 'Password must contain upper and lower case letters and at least 1 number and special characters, such as @, #, $.',
            'password.regex' => 'Password must contain upper and lower case letters and at least 1 number and special characters, such as @, #, $.',
        ];
    }
}

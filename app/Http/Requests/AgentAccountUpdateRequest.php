<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentAccountUpdateRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'First name cannot be blank.',
            'lastname.required' => 'Last name cannot be blank.',
            'email.required' => 'Email cannot be blank.',
            'phoneno.required' => 'Phone no cannot be blank.',
        ];
    }
}

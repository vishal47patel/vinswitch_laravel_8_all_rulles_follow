<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GatewayUpdateRequest extends FormRequest
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
            'gateway_name' => 'required|unique:gateways,gateway_name,'.$this->id,
            'expire_seconds' => 'required|numeric',
            'proxy' => 'required',
            'register' => 'required',
            'retry_seconds' => 'required|numeric',
            'username' => 'required_if:register,TRUE',
            'password' => 'required_if:register,TRUE',
        ];
    }
    public function messages()
    {
        return [
            'gateway_name.required' => 'Gatway Name is required!',
            'gateway_name.unique' => 'Gatway Name is Unique!',
            'expire_seconds.required' => 'Expire Second is required!',
            'expire_seconds.numeric' => 'Expire Second allow only number is required!',
            'proxy' => 'Proxy is required!',
            'register' => 'Register is required!',
            'retry_seconds.required' => 'Retry Seconds is required!',
            'retry_seconds.numeric' => 'Retry Seconds allow only number is required!',
            'username.required_if' => 'The Username field is required when register is TRUE.',
            'password.required_if' => 'The Password field is required when register is TRUE.',
        ];
    }
}

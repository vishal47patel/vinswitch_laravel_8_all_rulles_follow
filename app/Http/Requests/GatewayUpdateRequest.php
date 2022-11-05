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
            'gateway_name' => 'required',
            'expire_seconds' => 'required|numeric',
            'proxy' => 'required',
            'register' => 'required',
            'retry_seconds' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'gateway_name' => 'Gatway Name is required!',
            'expire_seconds.required' => 'Expire Second is required!',
            'expire_seconds.numeric' => 'Expire Second allow only number is required!',
            'proxy' => 'Proxy is required!',
            'register' => 'Register is required!',
            'retry_seconds.required' => 'Retry Seconds is required!',
            'retry_seconds.numeric' => 'Retry Seconds allow only number is required!',
        ];
    }
}

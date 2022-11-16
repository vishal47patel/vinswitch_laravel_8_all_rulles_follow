<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FreeswitchServerStoreRequest extends FormRequest
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
            'freeswitch_host' => 'required',
            'freeswitch_password' => 'required',
            'freeswitch_port' => 'required|max:10',
        ];
        
    }
    public function messages()
    {
        return [
            'freeswitch_host.required' => 'Freeswitch host is required!',
            'freeswitch_password.required' => 'Freeswitch password is required!',
            'freeswitch_port.required' => 'Freeswitch port is required!',
            'freeswitch_host.max' => 'Please Enter max length 10!',
        ];
    }
}

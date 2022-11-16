<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DidNumberStoreRequest extends FormRequest
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
            'number_did' => 'required|numeric|max:11',
            'number_service_type' => 'required',
            'number_channel_limit' => 'required|numeric',
            'number_country' => 'required',   
            'username' => 'required_if:register,TRUE',
            'password' => 'required_if:register,TRUE',     
        ];
    }
    public function messages()
    {
        return [
            'number_did.required' => 'Number is required!',
            'number_did.numeric' => 'Number allow only number is required!',
            'number_did.max' => 'Number allow maximum 11 digit!',
            'number_service_type.required' => 'Please select Service Type!',
            'number_channel_limit.required' => 'Channel Limit is required!',
            'number_channel_limit.numeric' => 'Channel Limit allow only number is required!',
            'number_country' => 'Please select Country!',
            
        ];
    }
}

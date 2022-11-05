<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorSettingStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'setting_key' => 'required',
            'setting_value' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'setting_key.required' => 'Setting Key is required!',
            'setting_value.required' => 'Setting Value is required!',            
        ];
    }
}

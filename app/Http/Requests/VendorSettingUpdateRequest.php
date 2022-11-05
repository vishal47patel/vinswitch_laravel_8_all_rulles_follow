<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorSettingUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'setting_value' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'setting_value.required' => 'Setting Value is required!',            
        ];
    }
}

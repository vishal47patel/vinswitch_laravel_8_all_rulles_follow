<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorStoreRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'vendor_name' => 'required',
            'vendor_code' => 'required|numeric',
            'did_type' => 'required',
            'status' => 'required',
            'priority' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'vendor_name' => 'Vendor Name is required!',
            'vendor_code.required' => 'Vendor Code is required!',
            'vendor_code.numeric' => 'Vendor Code allow only number is required!',
            'did_type' => 'Did Type is required!',
            'status' => 'Status is required!',
            'priority.required' => 'Priority is required!',
            'priority.numeric' => 'Priority allow only number is required!',
        ];
    }
}

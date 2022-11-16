<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OriginationRatePlanStoreRequest extends FormRequest
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
            'name' => 'required',
            "moreFields"    => "required|array",
            "moreFields.*.service_type"    => "required",
            'moreFields.*.service_type' => 'required|different:service_type',
           
        ];
        
    }
    public function messages()
    {
        return [
            'name.required' => 'Name cannot be blank.',
            "moreFields.*.service_type.required" => 'Service type cannot be blank....',
          
           
        ];
    }
}

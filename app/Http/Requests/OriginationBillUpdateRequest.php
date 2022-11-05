<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OriginationBillUpdateRequest extends FormRequest
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
            'bill_plan_type' => 'required',
            'bill_plan_name' => 'required|unique:origination_bill_plan,bill_plan_name,'.$this->id,
            'origination_rate_plan' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'bill_plan_type.required' => 'Bill Plan Type cannot be blank.',
            'bill_plan_name.required' => 'Bill Plan Name cannot be blank.',
            'bill_plan_name.unique' => 'Bill Plan Name cannot be same.',
            'origination_rate_plan.required' => 'Origination Rate Plan cannot be blank.',
        ];
    }
}

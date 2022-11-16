<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantBillStoreRequest extends FormRequest
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
            'billplan_method' => 'required',
            'origination_bill_plan_id' => 'required',
            'bill_plan_id' => 'required',
            'credit_limit' => 'required_if:billplan_method,POSTPAID',
            'call_per_seconds' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'billplan_method' => 'Bill Plan Method cannot be blank.',
            'origination_bill_plan_id.required' => 'Origination Bill Plan cannot be blank.',
            'bill_plan_id.required' => 'Bill Plan Method cannot be blank.',
            'call_per_seconds.required' => 'Call Per Seconds cannot be blank.',
            'credit_limit.required_if' => 'Credit limit cannot be blank.',
        ];
    }
}

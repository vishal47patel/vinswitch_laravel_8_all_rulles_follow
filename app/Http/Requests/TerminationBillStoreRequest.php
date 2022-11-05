<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TerminationBillStoreRequest extends FormRequest
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
            'type' => 'required',
            'name' => 'required|unique:bill_plan,name',
            'pulse_rate' => 'required',
            'monthly_payment' => 'required',
            'monthly_mins' => 'required',
            'sip_account_price' => 'required',
            'end_point_price' => 'required',
            'outbound_sms_price' => 'required',
            'rateplan_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Type cannot be blank.',
            'name.required' => 'Name cannot be blank.',
            'name.unique' => 'Name should be unique.',
            'pulse_rate.required' => 'Pulse Rate cannot be blank.',
            'monthly_payment.required' => 'Monthly Payment cannot be blank.',
            'monthly_mins.required' => 'Monthly Minutes cannot be blank.',
            'sip_account_price.required' => 'SIP Account Price cannot be blank.',
            'end_point_price.required' => 'End Point Price cannot be blank.',
            'outbound_sms_price.required' => 'Outbound SMS Price cannot be blank.',
            'rateplan_id.required' => 'Termination Rateplan cannot be blank.',
        ];
    }
}

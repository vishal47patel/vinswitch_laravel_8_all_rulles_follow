<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TerminationRateStoreRequest extends FormRequest
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
            'plan_name' => 'required',
            'cc' => 'required',
            'max_call_length' => 'required',
            'status' => 'required',
            'gateway_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'plan_name.required' => 'Plan Name cannot be blank.',
            'cc.required' => 'Concurrent Call cannot be blank.',
            'max_call_length.required' => 'Max Call Length cannot be blank.',
            'status.required' => 'Status cannot be blank.',
            'gateway_id.required' => 'Gateway cannot be blank.',
        ];
    }
}

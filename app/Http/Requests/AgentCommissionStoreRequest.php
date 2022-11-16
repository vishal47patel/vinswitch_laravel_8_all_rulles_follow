<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentCommissionStoreRequest extends FormRequest
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
            'payment_date' => 'required',
            'amount' => 'required',
            'payment_method' => 'required',
            'reference_number' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'payment_date.required' => 'Payment date cannot be blank.',
            'amount.required' => 'Amount cannot be blank.',
            'payment_method.required' => 'Payment method cannot be blank.',
            'reference_number.required' => 'Reference number cannot be blank.',
        ];
    }
}

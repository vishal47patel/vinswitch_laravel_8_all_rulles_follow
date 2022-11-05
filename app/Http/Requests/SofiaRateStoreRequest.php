<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SofiaRateStoreRequest extends FormRequest
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
            'code' => 'required',
            'description' => 'required',
            'buy_rate' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Code cannot be blank.',
            'description.required' => 'Description cannot be blank.',
            'buy_rate.required' => 'Buy Rate cannot be blank.',
        ];
    }
}

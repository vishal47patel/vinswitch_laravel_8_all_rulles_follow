<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SofiaRateImportRequest extends FormRequest
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
            'sale_percentage' => 'required',
            'import_csv' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'sale_percentage' => 'Sell Rate(%) cannot be blank.',
            'import_csv.required' => 'Import CSV cannot be blank.',
        ];
    }
}

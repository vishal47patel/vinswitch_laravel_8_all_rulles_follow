<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AclNodesUpdateRequest extends FormRequest
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
            'cidr' => ['required','regex:/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?(\.|$)){3}/'],
            'type' => 'required|max:16',
            'list_id' => 'required|max:10',
            'is_endpoint' => 'required|max:3',
        ];
    }
    public function messages()
    {
        return [
            'cidr' => 'CIDR cannot be blank.',
            'list_id' => 'List cannot be blank.',
            'type' => 'Type cannot be blank.',
        ];
    }
}

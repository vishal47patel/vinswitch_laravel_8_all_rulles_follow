<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
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
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name cannot be blank.',
            'name.unique' => 'Name should be unique.',
            'permissions.required' => 'Permission cannot be blank.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
   
    public function rules()
    {
        return [
           'account_number' => 'required|max:10',
           'date' => 'required',
           'payment_method' => 'required',
           'reference_number' => 'required',
        ];
    }

    public function messages(){
        return [ 
            'account_number.required' => 'Payment is required!',
            'date.required' => 'Date is required!',
            'payment_method.required' => 'Payment Method is required!',
            'reference_number.required' => 'Reference Number is required!',
        ];
    }
    

}

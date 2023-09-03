<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BuyCableRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'serviceID' => ['required', 'string'],
            'billersCode' => ['required', 'string'],
            'variation_code' => ['required', 'string'],
            'subscription_type' => ['required_if:serviceID,==,dstv,gotv', Rule::in('renew', 'change')],
            'phone' => ['required', 'max:11', 'min:11'],
            'pay_service' => ['required', 'string', Rule::in(['wallet', 'flw', 'paystack'])],
            'pin' => ['numeric', 'digits:4']
        ];
    }

    public function messages()
    {
        return [
            'subscription_type.required_if' => "Please select what you want to do",
            'variation_code' => "Please select a package"
        ];
    }
}

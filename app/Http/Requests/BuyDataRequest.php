<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BuyDataRequest extends FormRequest
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
            'network' => ['required', 'string', 'exists:networks,name'],
            'plan_type' => ['required', 'string'],
            'amount' => ['required', 'string'],
            'phone' => ['required', 'string', 'digits:11'],
            'pay_service' => ['required', 'string', Rule::in(['wallet', 'flw', 'paystack'])],
            'pin' => ['numeric', 'digits:4']
        ];
    }
}

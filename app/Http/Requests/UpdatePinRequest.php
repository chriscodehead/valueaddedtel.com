<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPin;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePinRequest extends FormRequest
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
            'old_pin' => ['required', 'numeric', 'digits:4', new MatchOldPin],
            'pin' => ['required', 'numeric', 'digits:4'],
            'confirm_pin' => ['required', 'numeric', 'digits:4', 'same:pin']
        ];
    }

    public function messages()
    {
        return [
            'confirm_pin.same' => "PIN confirmation must match with new pin"
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'username' => 'required|string|between:2,100|unique:users',
            'firstname' => 'nullable|string',
            'lastname' => 'nullable|string',
            'email' => 'required|email|max:100|unique:users',
            'phone' => 'required|string|unique:users',
            'refer_by' => 'nullable|string|exists:users,my_ref_code',
            'password' => 'required|string|min:6|confirmed'
        ];
    }
}

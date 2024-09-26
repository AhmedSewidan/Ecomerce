<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:50',
            'email'         => 'required|email',
            'password'      => 'required|string|max:255|min:8',
            'city_id'       => 'required|integer',
            'address'       => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'address.required'  => 'Please enter your address',
        ];
    }
}

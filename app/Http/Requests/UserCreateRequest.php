<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'unique:users', 'regex:/^\+7[\d]{10}$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed', 'regex:/(?=.*[$%&!:])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z$%&!:]{6,}/'],
            'password_confirmation' => 'required_with:password|same:password'
        ];
    }

    public function message()
    {
        return [
            'phone.regex' => 'Phone format +7**********',
            'password.regex' => 'Require at least one uppercase and one lowercase letter and one of this symbols: $%&!:'
        ];
    }
}

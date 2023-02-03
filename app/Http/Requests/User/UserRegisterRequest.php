<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name' => 'bail|required|min:8|max:100|',
            'email' => 'bail|required|email|min:15|max:50|unique:users,email',
            'password' => 'bail|required|min:6|max:20|confirmed:password_confirmation',
            'password_confirmation' => 'bail|required|min:6',
        ];
    }
}

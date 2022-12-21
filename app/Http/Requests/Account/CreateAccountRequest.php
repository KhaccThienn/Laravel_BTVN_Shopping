<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
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
            'name' => 'bail|required|min:3|max:255',
            'email' => 'bail|required|email|min:3|max:255|unique:users,email',
            'password' => 'bail|required|min:3|max:255',
            'password_confirmation' => 'bail|required|same:password'
        ];
    }
}

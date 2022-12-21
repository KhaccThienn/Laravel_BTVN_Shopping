<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
            'name' => 'bail|required|min:4|max:255',
            'email' => 'bail|required|email|unique:users,email,'.$this->id,
            'password' => 'nullable|min:6|max:20',
            'password_confirmation' => 'bail|same:password'
        ];
    }
}

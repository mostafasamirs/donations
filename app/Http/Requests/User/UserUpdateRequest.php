<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function messages()
    {
      return [
        'name.required' =>__('Please Insert Data'),
        'email.required' =>__('Please Insert Data'),
        'phone.required' =>__('Please Insert Data'),
        'password.required' =>__('Please Insert Data'),
        'password_confirmation.required' =>__('Please Insert Data'),
        'address.required' =>__('Please Insert Data'),
        'type.required' =>__('Please Insert Data'),
        'lang.required' =>__('Please Insert Data'),
        'roles_name.required' =>__('Please Insert Data'),
      ];
    }

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
            'name' => 'required',
            // 'password' => 'sometimes:confirm-password',
            'phone' => 'required|unique:users,phone,'.$this->user->id.'',
            'email' => 'required|unique:users,email,'.$this->user->id.'',
            'password' => 'sometimes|confirmed',
            'address' => 'sometimes',
            'type' => 'required',
            'lang' => 'sometimes',
            'roles_name' => 'required',
        ];
    }
}

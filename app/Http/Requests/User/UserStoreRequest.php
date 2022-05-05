<?php

namespace App\Http\Requests\User;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
        'lang.required' =>__('Please Insert Data'),
        'roles_name.required' =>__('Please Insert Data'),

      ];
    }


    public function authorize()
    {
        App::setlocale(Auth::user()->lang);
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
            'phone' => 'required|unique:users,phone,',
            'email' => 'required|unique:users,email,',
            'password' => 'required|confirmed|min:8',
            'address' => 'required',
            'type' => 'required',
            'type' => 'required',
            'lang' => 'sometimes',
            'roles_name' => 'required',

        ];
    }
}

<?php

namespace App\Http\Requests\Donators;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class DonatorUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        App::setlocale(Auth::user()->lang);

        return true;
    }

    public function messages()
    {
      return [
        'name.required' =>__('Please Insert Data'),
        'phone.required' =>__('Please Insert Data'),
        // 'amount.required' =>__('Please Insert Data'),
      ];
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
            'phone' => 'sometimes',
            // 'amount' => 'required',
        ];
    }
}

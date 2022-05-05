<?php

namespace App\Http\Requests\category;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class categoryStoreRequest extends FormRequest
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
        // 'address.required' =>__('Please Insert Data'),
        // 'safe.required' =>__('Please Insert Data'),
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
            // 'address' => 'required',
            // 'safe' => 'required',
        ];
    }
}

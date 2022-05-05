<?php

namespace App\Http\Requests\Deposits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class DepositStoreRequest extends FormRequest
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
        'amount.required' =>__('Please Insert Data'),
        'image.required' =>__('Please Insert Data'),
        'date.required' =>__('Please Insert Data'),
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
            'amount' => 'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            // 'date' => 'required|date|date_format:Y-n-j',
            'date' => 'required',
        ];

    }
}

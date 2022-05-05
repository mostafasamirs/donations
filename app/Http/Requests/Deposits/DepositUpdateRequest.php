<?php

namespace App\Http\Requests\Deposits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class DepositUpdateRequest extends FormRequest
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
        'user_id.required' =>__('Please Insert Data'),
        'kiosk_id.required' =>__('Please Insert Data'),
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
            'user_id' => 'required',
            'kiosk_id' => 'required',
            'amount' => 'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            // 'date' => 'required|date|date_format:Y-n-j',
            'date' => 'required',
        ];
    }
}

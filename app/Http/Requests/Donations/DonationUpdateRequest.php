<?php

namespace App\Http\Requests\Donations;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class DonationUpdateRequest extends FormRequest
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
        'donator_id.required' =>__('Please Insert Data'),
        // 'phone.required' =>__('Please Insert Data'),
        'amount.required' =>__('Please Insert Data'),
        // 'date.required' =>__('Please Insert Data'),
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
            'donator_id' => 'required',
            'amount' => 'required',
            // 'phone' => 'required',
            // 'date' => 'required|date|date_format:Y-n-j',
            // 'date' => 'required',
        ];
    }
}

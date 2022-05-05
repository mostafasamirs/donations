<?php

namespace App\Http\Requests\Shifts;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ShiftStoreRequest extends FormRequest
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
        'start_time.required' =>__('Please Insert Data'),
        'end_time.required' =>__('Please Insert Data'),
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
            'start_time' => 'sometimes',
            'end_time' => 'sometimes',
        ];

    }
}

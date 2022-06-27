<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWeatherRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'address_id' => 'required|exists:addresses,id',
            'date' => 'required|date',
            'temp_max' => 'required|numeric',
            'temp_min' => 'required|numeric',
            'temp' => 'required|numeric',
            'dew' => 'required|numeric',
            'humidity' => 'required|numeric',
            'snow' => 'required|numeric',
            'sunrise' => 'required|string|max:255',
            'sunset' => 'required|string|max:255',
            'conditions' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertismentRequest extends FormRequest
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
        $rules = [
            'title' => 'required|min:2',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'media' => 'required',
            'url' => 'required|url',
            'position' => 'required',
            'client_id'  =>  'required',
        ];
        return $rules;
    }
}

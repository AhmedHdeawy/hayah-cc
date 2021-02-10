<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class CityRequest extends FormRequest
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
            'status'  =>  'required',
            'governorate_id'  =>  'required|numeric',
        ];

        $languages = Language::active()->get();
        foreach ($languages as $languag) {
            $rules[ $languag->locale. '.name' ] = 'required';
        }

        return $rules;
    }
}

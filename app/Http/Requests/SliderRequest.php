<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class SliderRequest extends FormRequest
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
            'url'  =>  'required',
        ];

        $languages = Language::active()->get();
        foreach ($languages as $languag) {
            $rules[ $languag->locale. '.title' ] = 'required';
        }

        return $rules;
    }
}

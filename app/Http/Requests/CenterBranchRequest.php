<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class CenterBranchRequest extends FormRequest
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
            'discount_value'  =>  'required',
            'latitude'  =>  'required',
            'longitude'  =>  'required',
            'logo'  =>  'required',
            'center_id'  =>  'required|numeric',
            'governorate_id'  =>  'required|numeric',
            'category_id'  =>  'required|numeric',
            'city_id'  =>  'required|numeric',
            'status'  =>  'required',
        ];

        $languages = Language::active()->get();
        foreach ($languages as $languag) {
            $rules[$languag->locale . '.name'] = 'required';
        }

        return $rules;
    }
}

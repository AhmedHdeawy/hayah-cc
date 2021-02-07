<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:2',
            'phone' => 'required|min:2|max:30|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'status' => 'required',
            'avatar'  =>  'image|nullable',
        ];

        if ($this->isMethod('PUT')) {
            $rules['email'] = 'required|email|unique:users,email,'. $this->segment(4) .',id';
            $rules['phone'] = 'required|unique:users,phone,'. $this->segment(4) .',id';
            $rules['password'] = 'confirmed';
            $rules['avatar']  =  'nullable|image';
        }

        return $rules;
    }
}

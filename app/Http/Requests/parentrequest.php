<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class parentrequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Password' => 'required',
            'Name_Father' => 'required',
            'Email' => 'unique:parents,Email,'.$this->id,
            'Name_Father_en' => 'required',
            'Phone_Father' => 'required',
            'Job_Father' => 'required',
            'Address_Father' => 'required',
        ];
        }
        
        public function messages()
        {
        return [
        
            'Email.unique' => trans('validation.unique'),
            'Password.required' => trans('validation.required'),
            'Name_Father.required' => trans('validation.required'),
            'Name_Father_en.required' => trans('validation.required'),
            'Phone_Father.required' => trans('validation.required'),
            'Job_Father.required' => trans('validation.required'),
            'Address_Father.required' => trans('validation.required'),
        ];
        }
}

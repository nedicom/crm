<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class LeadsRequest extends FormRequest
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
          'phone' => 'required|min:9|max:15',
          'name' => 'required'
        ];
    }

    public function messages(){
      return [
        'phone.required' => 'Телефон обязателен',
        'phone.min' => 'Телефон должен быть больше 9 цифр',
        'phone.max' => 'Телефон должен быть меньше 15 цифр',
        'name.required' => 'Имя обязательно'
      ];
    }
}

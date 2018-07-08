<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCadre extends FormRequest
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
    public function rules()   //输入字符的合法性
    {
        return [
            'cadre_trueName' => 'required|string|max:255',
            'cadre_phone' => 'required|string|max:11|unique:cadres',
        ];
    }
}

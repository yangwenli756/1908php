<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeoplePost extends FormRequest
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
        return [
            'username' => 'required|unique:people|max:3|min:1',
            'age'=>'required|min:1|max:3',
            'card'=>'required|min:1|max:11'
        ];
    }
    public function messages()
    {
       return [
           'username.required'=>'名字必填',
            'username.unique'=>'名字已存在',
            'age.required'=>'年龄必填',
            'card.required'=>'身份证号必填',
            'card.min'=>'身份证不合法',
            'card.max'=>'身份证不合法',
            'age.min'=>'年龄不合法',
            'age.max'=>'年龄不合法',
       ];
    }
}

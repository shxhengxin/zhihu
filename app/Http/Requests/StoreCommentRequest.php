<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'body' => 'required|min:12'
        ];
    }

    public function messages()
    {
        return [
            'body.required' => '答案内容不能为空',
            'body.min' => '我们答案内容不能少于12个字符'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // リクエストが許可されているかを判断するロジックを実装します。
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // バリデーションルールを定義します。
        return [
                'name' => 'required',
                'address' => 'required',
                'img' => 'required|file|mimes:jpg,png',
        ];
    }
}


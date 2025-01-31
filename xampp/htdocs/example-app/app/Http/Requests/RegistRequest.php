<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistRequest extends FormRequest
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
            'user_name' => ['required', 'regex:/^([a-zA-Z0-9]|[^\x01-\x7E\xA1-\xDF])+$/u'],
            'email' => ['required', 'regex:/^[a-zA-Z0-9@.]+$/'],
            'password' => ['required', 'regex:/^[a-zA-Z0-9]+$/', 'confirmed:passwordConfirm'],
            'passwordConfirm' => ['required', 'regex:/^[a-zA-Z0-9]+$/'],
        ];
    }
}
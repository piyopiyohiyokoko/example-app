<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditSchoolGradeRequest extends FormRequest
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
                'grade' => 'required',
                'term' => 'required',
                'japanese' => 'required',
                'math' => 'required',
                'science' => 'required',
                'social_studies' => 'required',
                'music' => 'required',
                'home_economics' => 'required',
                'english' => 'required',
                'art' => 'required',
                'health_and_physical_education' => 'required',
        ];
    }
}
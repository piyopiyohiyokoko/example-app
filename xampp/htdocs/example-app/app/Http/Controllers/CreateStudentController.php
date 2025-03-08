<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\CreateStudentRequest;
use Exception;

class CreateStudentController extends Controller
{
    protected $student;
    public function __construct()
    {
       $this->student= new Student();
    }

    /**
     * 学生登録画面表示
     * @return \Illuminate\Contracts\View\View
     */
    public function getIndex()
    {
        return view('student.create');
    }

    /**
     * 学生登録処理
     * @param CreateStudentRequest $request バリデーション済みリクエスト
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(CreateStudentRequest $request)
    {
        // 登録ボタンが押された場合
        if ($request->isMethod("post") && isset($request->create)) {
            try {
                $params = $request->except(['_token', 'create']);

                // モデルのメソッドを使用して画像処理と学生データの作成を行う
                $this->student->createOneWithImage($params, $request->file('img'));

                return back()->with('success', '登録が完了しました');
            } catch (Exception $e) {
                \Log::error('学生登録エラー: ' . $e->getMessage());
                return back()->with('error', '登録中にエラーが発生しました: ' . $e->getMessage())->withInput();
            }
        } else {
            // POST以外はエラーとする
            return back()->with('error', '不正なアクセスです')->withInput();
        }
    }
}

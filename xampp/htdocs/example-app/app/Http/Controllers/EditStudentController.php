<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\EditStudentRequest;
use Exception;

class EditStudentController extends Controller
{
    protected $student;

    public function __construct()
    {
        $this->student = new Student();
    }

    /**
     * 学生編集
     * @param EditStudentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditStudentRequest $request)
    {
        // 更新ボタンが押された場合
        if ($request->isMethod("post") && isset($request->edit)) {
            try {
                $params = $request->except(['_token', 'fileChangeFlg', 'edit']);

                // モデルのメソッドを使用して画像処理と学生データの更新を行う
                $this->student->editOneWithImage(
                    $params,
                    $request->file('img'),
                    $request->fileChangeFlg == "1"
                );

                return back()->with('success', '更新が完了しました');
            } catch (Exception $e) {
                \Log::error('学生編集エラー: ' . $e->getMessage());
                return back()->with('error', '更新中にエラーが発生しました: ' . $e->getMessage());
            }
        } else {
            // POST以外はエラーとする
            return back()->with('error', '不正なアクセスです');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DisplayStudentEditController extends Controller
{
    /**
     * 学生編集画面表示
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Request $request, $id)
    {
        // DBから対象学生データを取得
        $student = Student::findOrFail($id);

        // データの取得に失敗した場合
        if ($student == null) {
            Session::flash('error', 'データの取得に失敗しました');
        }

        // 学生編集ビューを呼び出し
        return view('student/edit', compact('student'));
    }
}

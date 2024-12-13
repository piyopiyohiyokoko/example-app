<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DisplayStudentEditController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
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

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DisplaySchoolGradeEditController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        // DBから対象成績データを取得
        $schoolGrade = SchoolGrade::findOrFail($id);

        // 生徒IDから学生データを取得
        $student = Student::findOrFail($schoolGrade->student_id);

        // データの取得に失敗した場合
        if($schoolGrade == null || $student == null) {
           Session::flash('error', 'データの取得に失敗しました');
        }

        // 成績編集ビューを呼び出し
        return view('schoolGrade/edit', array_merge(compact('student'), compact('schoolGrade')));
    }
}

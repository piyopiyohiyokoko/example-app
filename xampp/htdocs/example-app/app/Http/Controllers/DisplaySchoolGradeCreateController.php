<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class DisplaySchoolGradeCreateController extends Controller
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

        // 成績登録ビューを呼び出し
        return view('schoolGrade/create', compact('student'));
    }
}

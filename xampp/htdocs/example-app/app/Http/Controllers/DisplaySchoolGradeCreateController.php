<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class DisplaySchoolGradeCreateController extends Controller
{
    /**
     * 成績登録画面表示
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request, $id)
    {
        // DBから対象学生データを取得
        $student = Student::findOrFail($id);

        // 成績登録ビューを呼び出し
        return view('schoolGrade/create', compact('student'));
    }
}

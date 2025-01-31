<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolGrade;
use Illuminate\Http\Request;

class DisplayStudentDetailController extends Controller
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
        
        // 成績情報
        $schoolGrade = null;
        // 検索ボタンが押された場合
        if (isset($request->search)) {

            // DBから対象成績データを取得
            $schoolGrade = SchoolGrade::where('student_id', $id)
                ->where('grade', $request->grade)
                ->where('term', $request->term)
                ->first();

            // 成績情報が取得できた場合
            if ($schoolGrade != null && $schoolGrade->count() > 0) {
                return response()->json($schoolGrade);
            
            } else {
                return response()->json(null);

            }

            return;
        }

        // 学生表示ビューを呼び出し
        return view('student/displayDetail', array_merge(compact('student'), compact('schoolGrade')));
    }
}

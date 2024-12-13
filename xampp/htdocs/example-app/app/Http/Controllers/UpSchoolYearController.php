<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class UpSchoolYearController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // 学年更新ボタンが押された場合
        if ($request->isMethod("post") && isset($request->upSchoolYear)) {

            // 学生の学年を繰り上げる
            $students = Student::where('grade', '<', 6)->get();

            foreach ($students as $student) {
                $student->grade += 1;
                $student->save();
            }
            
            return response()->json(['message' => '学年を更新しました', 'status' => 200], 200);

        } else {
            // POST以外はエラーとする
            return response()->json(['message' => '不正なアクセスです', 'status' => 404], 404);
        }
    }
}

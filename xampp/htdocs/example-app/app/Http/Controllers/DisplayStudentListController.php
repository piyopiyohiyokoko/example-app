<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class DisplayStudentListController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $students = [];

        // 昇順・降順ボタンが押された場合
        if (isset($request->sort)) {

            // ソート順を取得
            $sort = 'ASC';
            if (in_array($request->sort, ['ASC', 'DESC'])) {
                $sort = $request->sort;
            }

            // 検索条件を取得
            $serachStudentName = $request->searchName;
            $serachStudentGrade = $request->searchGrade;

            // 並び順を設定
            $students = Student::orderBy('grade', $sort);

            // 検索条件を設定
            if(empty($serachStudentName) === false) {
                $students->where('name', "LIKE", "%" . $serachStudentName . "%");
            }
            if(empty($serachStudentGrade) === false) {
                $students->where('grade', $serachStudentGrade);
            }

            // 検索処理実行
            $students = $students->get();

            // 学生リストが取得できた場合   
            if (is_null($students) === false) {
                // 学生リスト表示
            return response()->json($students);
            }

            return;
        }

        // 学生表示ビューを呼び出し
        return view('student/displayList');
    }
}

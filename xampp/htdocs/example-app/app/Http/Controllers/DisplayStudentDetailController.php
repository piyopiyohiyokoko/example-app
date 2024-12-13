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
                // 成績表示
                echo '<div>';
                echo '<label>学年時: </label>';
                echo '<label>' . $schoolGrade->grade . '</label>';
                echo '</div>';
                echo '<label>学期: </label>';
                echo '<label>' . $schoolGrade->term . '</label>';
                echo '</div>';
                echo '<div>';
                echo '<label>国語: </label>';
                echo '<label>' . $schoolGrade->japanese . '</label>';
                echo '</div>';
                echo '<div>';
                echo '<label>数学: </label>';
                echo '<label>' . $schoolGrade->math . '</label>';
                echo '</div>';
                echo '<div>';
                echo '<label>理科: </label>';
                echo '<label>' . $schoolGrade->science . '</label>';
                echo '</div>';
                echo '<div>';
                echo '<label>社会: </label>';
                echo '<label>' . $schoolGrade->social_studies . '</label>';
                echo '</div>';
                echo '<div>';
                echo '<label>音楽: </label>';
                echo '<label>' . $schoolGrade->music . '</label>';
                echo '</div>';
                echo '<div>';
                echo '<label>家庭科: </label>';
                echo '<label>' . $schoolGrade->home_economics . '</label>';
                echo '</div>';
                echo '<div>';
                echo '<label>英語: </label>';
                echo '<label>' . $schoolGrade->english . '</label>';
                echo '</div>';
                echo '<div>';
                echo '<label>美術: </label>';
                echo '<label>' . $schoolGrade->art . '</label>';
                echo '</div>';
                echo '<div>';
                echo '<label>保健体育: </label>';
                echo '<label>' . $schoolGrade->health_and_physical_education . '</label>';
                echo '</div>';
                echo '<a href="/displaySchoolGradeEdit/' . $schoolGrade->id . '"><button type="button">成績編集</button></a>';
                echo '<button type="button" onclick="clickSchoolGradeDeleteBtn()">成績削除</button>';
                echo '<input type="hidden" id="delete-grade-id" value="' . $schoolGrade->id . '">';
            
            } else {
                // 成績情報を取得できなかった場合
                echo '<div>検索条件に一致する成績情報はありません</div>';
            }

            return;
        }

        // 学生表示ビューを呼び出し
        return view('student/displayDetail', array_merge(compact('student'), compact('schoolGrade')));
    }
}

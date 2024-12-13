<?php

namespace App\Http\Controllers;

use App\Models\SchoolGrade;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;

class CreateSchoolGradeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // 登録ボタンが押された場合
        if ($request->isMethod("post") && isset($request->create)) {

            // バリデーション
            $request->validate([
                'grade' => 'required',
                'term' => 'required',
                'japanese' => 'required',
                'math' => 'required',
                'science' => 'required',
                'social_studies' => 'required',
                'music' => 'required',
                'home_economics' => 'required',
                'english' => 'required',
                'art' => 'required',
                'health_and_physical_education' => 'required',
            ]);

            // 対象の成績情報が登録されていないか、データ件数取得
            $count = SchoolGrade::where('student_id', $request->student_id)
                ->where('grade', $request->grade)
                ->where('term', $request->term)
                ->count();

            // 未登録の成績情報の場合
            if ($count == 0) {
                // 現在日時を "YYYY-MM-DD HH:MM:SS" 形式で取得
                $now = (new DateTime('now', new DateTimeZone('Asia/Tokyo')))->format('Y-m-d H:i:s');

                // DBに保存
                $schoolGrade = new SchoolGrade();
                $schoolGrade->student_id = $request->student_id;
                $schoolGrade->grade = $request->grade;
                $schoolGrade->term = $request->term;
                $schoolGrade->japanese = $request->japanese;
                $schoolGrade->math = $request->math;
                $schoolGrade->science = $request->science;
                $schoolGrade->social_studies = $request->social_studies;
                $schoolGrade->music = $request->music;
                $schoolGrade->home_economics = $request->home_economics;
                $schoolGrade->english = $request->english;
                $schoolGrade->art = $request->art;
                $schoolGrade->health_and_physical_education = $request->health_and_physical_education;
                $schoolGrade->created_at = $now;
                $schoolGrade->updated_at = $now;
                $schoolGrade->save();
                return back()->with('success', $request->grade . '学年' . $request->term . '学期の成績を登録しました');
            } else {
                // 登録済みの成績情報の場合
                return back()->with('success', $request->grade . '学年' . $request->term . '学期の成績は登録済みです');
            }

        } else {
            // POST以外はエラーとする
            return back()->with('error', '不正なアクセスです');
        }
    }
}

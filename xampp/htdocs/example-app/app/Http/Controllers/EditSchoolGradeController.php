<?php

namespace App\Http\Controllers;

use App\Models\SchoolGrade;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;

class EditSchoolGradeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // 更新ボタンが押された場合
        if ($request->isMethod("post") && isset($request->edit)) {

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

            // 現在日時を "YYYY-MM-DD HH:MM:SS" 形式で取得
            $now = (new DateTime('now', new DateTimeZone('Asia/Tokyo')))->format('Y-m-d H:i:s');

            // トランザクションを開始
            DB::beginTransaction();

            try {
                // 同様の学年、学期の成績が他に存在していれば削除する
                SchoolGrade::where('grade', $request->grade)
                    ->where('term', $request->term)
                    ->where('id', '!=', $request->schoolGradeId)
                    ->delete();

                // DBを更新
                $schoolGrade = SchoolGrade::find($request->schoolGradeId);
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
                $schoolGrade->updated_at = $now;
                $schoolGrade->save();

                // コミット
                DB::commit();

                return back()->with('success', '成績を更新しました');

            } catch (\Exception $e) {
                // エラー発生時はロールバック
                DB::rollBack();
                return back()->with('success', '成績の更新に失敗しました');
            }

        } else {
            // POST以外はエラーとする
            return back()->with('error', '不正なアクセスです');
        }
    }
}

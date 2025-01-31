<?php

namespace App\Http\Controllers;

use App\Models\SchoolGrade;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\EditSchoolGradeRequest;
use DateTime;
use DateTimeZone;

class EditSchoolGradeController extends Controller
{
    protected $school_grade;
    public function __construct()
    {
       $this->school_grade= new SchoolGrade();
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(EditSchoolGradeRequest $request)
    {
        // 更新ボタンが押された場合
        if ($request->isMethod("post") && isset($request->edit)) {

            $params = $request->except(['_token']);

            // トランザクションを開始
            DB::beginTransaction();

            try {
                    $this->school_grade->editOne($params);
                // コミット
                DB::commit();
                
            } catch (\Exception $e) {
                // エラー発生時はロールバック
                DB::rollBack();
                return back()->with('success', '成績の更新に失敗しました');
            }

            return back()->with('success', '成績を更新しました');

        } else {
            // POST以外はエラーとする
            return back()->with('error', '不正なアクセスです');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SchoolGrade;
use Illuminate\Http\Request;
use App\Http\Requests\CreateSchoolGradeRequest;
use DateTime;
use DateTimeZone;

class CreateSchoolGradeController extends Controller
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
    public function __invoke(CreateSchoolGradeRequest $request)
    {
        // 登録ボタンが押された場合
        
        if ($request->isMethod("post") && isset($request->create)) {

            // 対象の成績情報が登録されていないか、データ件数取得
            $count = SchoolGrade::where('student_id', $request->student_id)
                ->where('grade', $request->grade)
                ->where('term', $request->term)
                ->count();

            // 未登録の成績情報の場合
            if ($count == 0) {
                $params = $request->except(['_token']);

                try{
                    $this->school_grade->createOne($params);
    
                }catch(Exception $e){
                    $e->getMessage();
                }
    
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

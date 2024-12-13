<?php

namespace App\Http\Controllers;

use App\Models\SchoolGrade;
use Illuminate\Http\Request;

class DeleteSchoolGradeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // 削除ボタンが押された場合
        if ($request->isMethod("post") && isset($request->delete)) {

            // DBから対象データを削除
            $deleted = SchoolGrade::destroy($request->id);

            if ($deleted) {
                return response()->json(['message' => '成績データを削除しました', 'status' => 200], 200);
            } else {
                return response()->json(['message' => '削除対象データが見つかりませんでした', 'status' => 404], 404);
            }

        } else {
            // POST以外はエラーとする
            return response()->json(['message' => '不正なアクセスです', 'status' => 404], 404);
        }
    }
}

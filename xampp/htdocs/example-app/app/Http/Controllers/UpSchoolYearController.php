<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;

class UpSchoolYearController extends Controller
{
    /**
     * 学年更新
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        // 学年更新ボタンが押された場合
        if ($request->isMethod("post") && isset($request->upSchoolYear)) {
            try {
                // Studentモデルのupdateメソッドを使用して一括更新
                $student = new Student();
                $updateCount = $student->updateSchoolYear();

                return response()->json([
                    'message' => "学年を更新しました。{$updateCount}人の学生が進級しました。",
                    'status' => 200
                ], 200);
            } catch (QueryException $e) {
                // データベースクエリに関連するエラー
                \Log::error('データベース更新エラー: ' . $e->getMessage());
                return response()->json(['message' => 'データベース更新中にエラーが発生しました', 'status' => 500], 500);
            } catch (Exception $e) {
                // その他の例外
                \Log::error('学年更新エラー: ' . $e->getMessage());
                return response()->json(['message' => '学年更新中にエラーが発生しました', 'status' => 500], 500);
            }
        } else {
            // POST以外はエラーとする
            return response()->json(['message' => '不正なアクセスです', 'status' => 404], 404);
        }
    }
}

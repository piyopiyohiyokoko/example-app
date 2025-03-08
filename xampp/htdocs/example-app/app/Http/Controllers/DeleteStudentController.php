<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;

class DeleteStudentController extends Controller
{
    /**
     * 学生削除
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        // 削除ボタンが押された場合
        if ($request->isMethod("post") && isset($request->delete)) {
            try {
                // StudentモデルのdeleteOneメソッドを使用して削除
                $student = new Student();
                $deleted = $student->deleteOne($request->id);

                if ($deleted) {
                    return response()->json(['message' => '学生データを削除しました', 'status' => 200], 200);
                } else {
                    return response()->json(['message' => '削除対象データが見つかりませんでした', 'status' => 404], 404);
                }
            } catch (QueryException $e) {
                // データベースクエリに関連するエラー
                \Log::error('データベースエラー: ' . $e->getMessage());
                return response()->json(['message' => 'データベースエラーが発生しました', 'status' => 500], 500);
            } catch (Exception $e) {
                // その他の例外
                \Log::error('削除処理エラー: ' . $e->getMessage());
                return response()->json(['message' => '削除処理中にエラーが発生しました', 'status' => 500], 500);
            }
        } else {
            // POST以外はエラーとする
            return response()->json(['message' => '不正なアクセスです', 'status' => 404], 404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;

class EditStudentController extends Controller
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
                'name' => 'required',
                'address' => 'required',
                'img' => 'file|mimes:jpg,png',
            ]);

            // 現在日時を "YYYY-MM-DD HH:MM:SS" 形式で取得
            $now = (new DateTime('now', new DateTimeZone('Asia/Tokyo')))->format('Y-m-d H:i:s');

            // ファイル変更があった場合
            if($request->fileChangeFlg == "1") {
                // ファイルを取得
                $file = $request->file('img');
                // ファイルを保存(public/uploads に保存)
                $path = $file->store('', 'public');
            }
            
            // DBに保存
            $student = Student::find($request->id);
            $student->grade = $request->grade;
            $student->name = $request->name;
            $student->address = $request->address;
            if($request->fileChangeFlg == "1") {
                $student->img_path = "uploads/" . $path;
            }
            $student->comment = $request->comment;
            $student->updated_at = $now;
            $student->save();

            return back()->with('success', '更新が完了しました');

        } else {
            // POST以外はエラーとする
            return back()->with('error', '不正なアクセスです');
        }
    }
}

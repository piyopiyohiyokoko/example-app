<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;

class CreateStudentController extends Controller
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
                'name' => 'required',
                'address' => 'required',
                'img' => 'required|file|mimes:jpg,png',
            ]);

            // 現在日時を "YYYY-MM-DD HH:MM:SS" 形式で取得
            $now = (new DateTime('now', new DateTimeZone('Asia/Tokyo')))->format('Y-m-d H:i:s');

            // ファイルを取得
            $file = $request->file('img');
            // ファイルを保存(public/uploads に保存)
            $path = $file->store('', 'public');

            // DBに保存
            $student = new Student();
            $student->name = $request->name;
            $student->address = $request->address;
            $student->img_path = "uploads/" . $path;
            $student->comment = $request->comment;
            $student->created_at = $now;
            $student->updated_at = $now;
            $student->save();

            return back()->with('success', '登録が完了しました');
        }

        // 学生登録ビューを呼び出し
        return view('student/create', []);
    }
}

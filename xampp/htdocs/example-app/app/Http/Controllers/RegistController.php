<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class RegistController extends Controller
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
        if ($request->isMethod("post") && isset($request->regist)) {
            try {
                // バリデーション
                $request->validate([
                    'userName' => ['required', 'regex:/^([a-zA-Z0-9]|[^\x01-\x7E\xA1-\xDF])+$/u'],
                    'email' => ['required', 'regex:/^[a-zA-Z0-9@.]+$/'],
                    'password' => ['required', 'regex:/^[a-zA-Z0-9]+$/', 'confirmed:passwordConfirm'],
                    'passwordConfirm' => ['required', 'regex:/^[a-zA-Z0-9]+$/'],
                ]);
            } catch (ValidationException $e) {
                // バリデーションエラーをJSONで返す
                return response()->json([
                    'message' => 'バリデーションエラー',
                    'errors' => $e->errors(),
                    'status' => 422
                ], 422);
            }

            // メールアドレスが登録済みでないかチェック
            $emailExists = User::where('email', $request->email)->exists();

            if ($emailExists) {
                // 登録済みの場合
                return response()->json([
                    'message' => '重複エラー',
                    'errors' => ['email' => ['すでに登録済みのメールアドレスです']],
                    'status' => 422
                ], 422);
            }

            // 現在日時を "YYYY-MM-DD HH:MM:SS" 形式で取得
            $now = (new DateTime('now', new DateTimeZone('Asia/Tokyo')))->format('Y-m-d H:i:s');

            // DBに保存
            $user = new User();
            $user->user_name = $request->userName;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->created_at = $now;
            $user->updated_at = $now;
            $user->save();
            return response()->json(['message' => '登録が完了しました', 'status' => 200], 200);
        } else {
            // POST以外はエラーとする
            return response()->json(['message' => '不正なアクセスです', 'status' => 404], 404);
        }
    }
}

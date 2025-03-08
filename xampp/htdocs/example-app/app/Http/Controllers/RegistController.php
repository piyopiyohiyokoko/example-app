<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegistRequest;
use DateTime;
use DateTimeZone;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class RegistController extends Controller
{
    protected $user;
    public function __construct()
    {
       $this->user= new User();
    }

    /**
     * 管理ユーザー登録
     * @param RegistRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RegistRequest $request)
    {
        // 登録ボタンが押された場合
        if ($request->isMethod("post") && isset($request->regist)) {

            // メールアドレスが登録済みでないかチェック
            $emailExists = User::where('email', $request->email)->exists();

            $params = $request->except(['_token']);

            if ($emailExists) {
                // 登録済みの場合
                return response()->json([
                    'message' => '重複エラー',
                    'errors' => ['email' => ['すでに登録済みのメールアドレスです']],
                    'status' => 422
                ], 422);
            }

            try{
                $this->user->createOne($params);


            }catch(Exception $e){
                $e->getMessage();
            }

            return response()->json(['message' => '登録が完了しました', 'status' => 200], 200);
        } else {
            // POST以外はエラーとする
            return response()->json(['message' => '不正なアクセスです', 'status' => 404], 404);
        }
    }
}

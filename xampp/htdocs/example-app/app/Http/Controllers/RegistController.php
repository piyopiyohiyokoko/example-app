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
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegistRequest $request)
    {
        // 登録ボタンが押された場合
        if ($request->isMethod("post") && isset($request->regist)) {

            // メールアドレスが登録済みでないかチェック
            $emailExists = User::where('email', $request->email)->exists();

            $params = $request->except(['_token']);
            $params['password'] = Hash::make($request->password);

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

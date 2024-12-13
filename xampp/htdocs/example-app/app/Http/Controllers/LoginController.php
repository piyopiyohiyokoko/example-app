<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // バリデーション
        $request->validate([
            'email' => ['required', 'regex:/^[a-zA-Z0-9@.]+$/'],
            'password' => ['required', 'regex:/^[a-zA-Z0-9]+$/'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // ログイン成功
            // メニューページへ
            return redirect()->intended('/menu');
        } else {
            // ログイン失敗
            return back()->withErrors([
                'email' => 'メールアドレスまたはパスワードが間違っています',
            ]);
        }

        // メールアドレスが一致するレコードを取得
        // $user = User::where('email', $request->email)->first();

        // // 存在する場合、パスワードが一致するかを確認
        // if ($user && $request->password == $user->password) {
        //     // 一致する場合
        //     // セッション作成
        //     $request->session()->regenerate();

        //     // メニューページへ
        //     return redirect()->intended('/menu');
            
        // } else {
        //     // 一致しない場合
        //     return back()->with('error', 'メールアドレスまたはパスワードが間違っています');
        // }

    }
}

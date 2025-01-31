<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        try{
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
        }catch(Exception $e){
            \Log::error($e->getMessage());
        }
    }
}

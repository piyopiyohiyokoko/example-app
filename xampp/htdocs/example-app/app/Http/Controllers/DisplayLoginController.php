<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisplayLoginController extends Controller
{
    /**
     * ログイン画面表示
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * ログイン処理
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/menu');
        }

        return back()->withErrors([
            'email' => 'ユーザー名またはパスワードが正しくありません。',
        ])->withInput($request->only('email'));
    }
}

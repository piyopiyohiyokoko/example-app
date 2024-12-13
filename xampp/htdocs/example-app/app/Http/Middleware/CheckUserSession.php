<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserSession
{
    public function handle($request, Closure $next)
    {
        // セッションが存在しない場合、ログイン画面にリダイレクト
        if (!Auth::check()) {
            return redirect('/');
        }

        return $next($request);
    }
}

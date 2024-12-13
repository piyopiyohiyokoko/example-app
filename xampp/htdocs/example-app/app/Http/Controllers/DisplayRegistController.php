<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;

class DisplayRegistController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // 管理ユーザー新規登録ビューを呼び出し
        return view('user/regist', []);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;

class DisplayRegistController extends Controller
{
    /**
     * 管理ユーザー新規登録画面表示
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // 管理ユーザー新規登録ビューを呼び出し
        return view('user.regist');
    }
}

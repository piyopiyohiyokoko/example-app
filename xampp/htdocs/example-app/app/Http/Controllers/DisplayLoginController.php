<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisplayLoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // ログインビューを呼び出し
        return view('user/index', []);
    }
}

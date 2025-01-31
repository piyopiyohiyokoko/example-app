<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\CreateStudentRequest;
use DateTime;
use DateTimeZone;

class CreateStudentController extends Controller
{
    protected $student;
    public function __construct()
    {
       $this->student= new Student();
    }

     public function getIndex()
    {
        // 学生登録ビューを呼び出し
        return view('student/create');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(CreateStudentRequest $request)
    {
        // 登録ボタンが押された場合

         // ファイルを取得
        $file = $request->file('img');
        // ファイルを保存(public/uploads に保存)
        $path = $file->store('', 'public');


        $params = $request->except(['_token','img']);
        $params['img_path'] =  "uploads/" . $path;

        try{
            $this->student->createOne($params);

        }catch(Exception $e){
            $e->getMessage();
        }

        return back()->with('success', '登録が完了しました');
    }
}

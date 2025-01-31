<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\EditStudentRequest;
use DateTime;
use DateTimeZone;

class EditStudentController extends Controller
{
    protected $student;
    public function __construct()
    {
       $this->student= new Student();
    }
    
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(EditStudentRequest $request)
    {
        // 更新ボタンが押された場合
        if ($request->isMethod("post") && isset($request->edit)) {

            $params = $request->except(['_token', 'fileChangeFlg']);

            // ファイル変更があった場合
            if($request->fileChangeFlg == "1") {
                // ファイルを取得
                $file = $request->file('img');
                // ファイルを保存(public/uploads に保存)
                $path = $file->store('', 'public');
                $student_img_path = "uploads/" . $path;
                $params['img_path']=$student_img_path;
            }

            try{
                $this->student->editOne($params);

            }catch(Exception $e){
                $e->getMessage();
            }
            return back()->with('success', '更新が完了しました');

        } else {
            // POST以外はエラーとする
            return back()->with('error', '不正なアクセスです');
        }
    }
}

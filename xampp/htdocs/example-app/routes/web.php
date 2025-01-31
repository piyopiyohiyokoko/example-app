<?php

use Illuminate\Support\Facades\Route;

// 管理ユーザーログイン画面
Route::get('', 'App\Http\Controllers\DisplayLoginController');
Route::get('login', 'App\Http\Controllers\DisplayLoginController');
// 管理ユーザー新規登録画面
Route::get('displayRegist', 'App\Http\Controllers\DisplayRegistController');

// 管理ユーザーログイン
Route::post('login', 'App\Http\Controllers\LoginController@post');
// 管理ユーザー登録
Route::post('regist', 'App\Http\Controllers\RegistController');

// セッション管理を行うルート
Route::middleware('auth')->group(function () {
    // メニュー
    Route::get('menu', 'App\Http\Controllers\MenuController');
    // 学年更新
    Route::post('upSchoolYear', 'App\Http\Controllers\UpSchoolYearController');

    // 学生表示画面
    Route::get('displayStudentList', 'App\Http\Controllers\DisplayStudentListController');
    // 学生詳細画面
    Route::get('displayStudentDetail/{id}', 'App\Http\Controllers\DisplayStudentDetailController');
    // 学生編集画面
    Route::get('displayStudentEdit/{id}', 'App\Http\Controllers\DisplayStudentEditController');
    // 学生登録
    Route::get('createStudent', 'App\Http\Controllers\CreateStudentController@getIndex');
    Route::post('createStudent', 'App\Http\Controllers\CreateStudentController@postCreate');
    // 学生編集
    Route::post('editStudent', 'App\Http\Controllers\EditStudentController');
    // 学生削除
    Route::post('deleteStudent', 'App\Http\Controllers\DeleteStudentController');

    // 成績登録画面
    Route::get('displaySchoolGradeCreate/{id}', 'App\Http\Controllers\DisplaySchoolGradeCreateController');
    // 成績編集画面
    Route::get('displaySchoolGradeEdit/{id}', 'App\Http\Controllers\DisplaySchoolGradeEditController');
    // 成績登録
    Route::post('createSchoolGrade', 'App\Http\Controllers\CreateSchoolGradeController');
    // 成績編集
    Route::post('editSchoolGrade', 'App\Http\Controllers\EditSchoolGradeController');
    // 成績削除
    Route::post('deleteSchoolGrade', 'App\Http\Controllers\DeleteSchoolGradeController');

    
});

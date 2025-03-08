<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayLoginController;
use App\Http\Controllers\DisplayRegistController;
use App\Http\Controllers\RegistController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UpSchoolYearController;
use App\Http\Controllers\DisplayStudentListController;
use App\Http\Controllers\DisplayStudentDetailController;
use App\Http\Controllers\DisplayStudentEditController;
use App\Http\Controllers\CreateStudentController;
use App\Http\Controllers\EditStudentController;
use App\Http\Controllers\DeleteStudentController;
use App\Http\Controllers\DisplaySchoolGradeCreateController;
use App\Http\Controllers\DisplaySchoolGradeEditController;
use App\Http\Controllers\CreateSchoolGradeController;
use App\Http\Controllers\EditSchoolGradeController;
use App\Http\Controllers\DeleteSchoolGradeController;

// 管理ユーザーログイン画面
Route::get('/', [DisplayLoginController::class, 'index']);
// ログインページのルートを追加
Route::get('/login', [DisplayLoginController::class, 'index'])->name('login');
// ログイン処理用のPOSTルート
Route::post('/login', [DisplayLoginController::class, 'authenticate']);
// 管理ユーザー新規登録画面
Route::get('/displayRegist', [DisplayRegistController::class, 'index']);
// 管理ユーザー登録
Route::post('/regist', [RegistController::class, 'index']);

// セッション管理を行うルート
Route::middleware('auth')->group(function () {
    // メニュー
    Route::get('/menu', [MenuController::class, 'index']);
    // 学年更新
    Route::post('/upSchoolYear', [UpSchoolYearController::class, 'update']);

    // 学生表示画面
    Route::get('/displayStudentList', [DisplayStudentListController::class, 'index']);
    // 学生詳細画面
    Route::get('/displayStudentDetail/{id}', [DisplayStudentDetailController::class, 'show']);
    // 学生編集画面
    Route::get('/displayStudentEdit/{id}', [DisplayStudentEditController::class, 'edit']);
    // 学生登録
    Route::get('/createStudent', [CreateStudentController::class, 'getIndex']);
    Route::post('/createStudent', [CreateStudentController::class, 'postCreate']);
    // 学生編集
    Route::post('/editStudent', [EditStudentController::class, 'update']);
    // 学生削除
    Route::post('/deleteStudent', [DeleteStudentController::class, 'delete']);

    // 成績登録画面
    Route::get('/displaySchoolGradeCreate/{id}', [DisplaySchoolGradeCreateController::class, 'index']);
    // 成績編集画面
    Route::get('/displaySchoolGradeEdit/{id}', [DisplaySchoolGradeEditController::class, 'edit']);
    // 成績登録
    Route::post('/createSchoolGrade', [CreateSchoolGradeController::class, 'score']);
    // 成績編集
    Route::post('/editSchoolGrade', [EditSchoolGradeController::class, 'update']);
    // 成績削除
    Route::post('/deleteSchoolGrade', [DeleteSchoolGradeController::class, 'delete']);
});

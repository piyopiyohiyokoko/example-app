<?php

// ユーザアカウント登録モデルクラスファイル読み込み
require_once __DIR__ . '/../model/userRegistrationModel.php';
// データベースクラスファイル読み込み
require_once __DIR__ . '/../model/dbManager.php';

    // データベース管理クラス生成
    $myDb = new DbManager();

    // POST通信で登録ボタンが押された場合
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user-regist-btn'])) {
        // 入力値取得
        $loginId = $_POST['regist-login-id'];
        $password = $_POST['regist-password'];
        
        // モデルインスタンス生成
        $userRegistrationModel = new UserRegistrationModel($loginId, $password);

        // アカウント登録
        if (empty($ver)) {
            $ver = $userRegistrationModel->registerUserInfomation($myDb);
        }

        // アカウント登録した場合
        if (empty($ver)) {
            // JavaScriptのポップアップでメッセージを表示
            echo '<script type="text/javascript">alert("会員を登録しました");</script>';
        }
    }


// 会員登録テンプレートファイル読み込み
include_once __DIR__ . '/../view/userRegistView.php';

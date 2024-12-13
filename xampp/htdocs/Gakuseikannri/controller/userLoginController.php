<?php
if (!session_id()) {
    session_start();
}

// ログインモデルクラス読み込み
require_once __DIR__ . '/../model/userLoginModel.php';
// データベースクラスファイル読み込み
require_once __DIR__ . '/../model/dbManager.php';

$myDb = new DbManager();

// POST通信でログインボタンが押された場合
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user-login-btn'])) {
        // 入力値を取得
        $loginId = $_POST['input-login-id'];
        $password = $_POST['input-password'];
        
        // モデルクラス生成
        $userLoginModel = new UserLoginModel($loginId, $password);

        // 認証処理実行
        if (empty($ver)) {
            // 会員ログインチェック
            $ver = $userLoginModel->authenticationMenberLogin($myDb);

            // 認証の場合
            if (empty($ver)) {
                // ログインユーザIDセッションを設定
                $_SESSION['logined-user-id'] = $loginId;
                // 学生一覧ページへ移動
                header('Location:./gakusei-list.php');
                exit();
            }
        }
    }

// ログインテンプレートファイル読み込み
include_once __DIR__ . '/../view/userLoginView.php';

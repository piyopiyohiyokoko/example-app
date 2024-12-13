<?php

// 学生登録モデルクラスファイル読み込み
require_once __DIR__ . '/../model/gakuseiRegistrationModel.php';
// データベースクラスファイル読み込み
require_once __DIR__ . '/../model/dbManager.php';



    // データベース管理クラス生成
    $myDb = new DbManager();

    // POST通信で登録ボタンが押された場合
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['gakusei-regist-btn'])) {
        // 入力値取得
        $productName = $_POST['regist-product-name'];
        $gakuseiCount = $_POST['regist-gakusei-count'];
        
        // モデルインスタンス生成
        $gakuseiRegistrationModel = new GakuseiRegistrationModel($productName, (int)$gakuseiCount);

        // 学生登録
        if (empty($var)) {
            $var = $gakuseiRegistrationModel->registerGakuseiInfomation($myDb);
        }

        // 学生登録した場合
        if (empty($var)) {
            // JavaScriptのポップアップでメッセージを表示
            echo '<script type="text/javascript">alert("学生を登録しました");</script>';
        }
    }

// 学生登録ファイル読み込み
include_once __DIR__ . '/../view/gakuseiRegistView.php';

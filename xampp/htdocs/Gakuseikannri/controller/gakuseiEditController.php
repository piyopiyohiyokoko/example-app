<?php

// 学生編集モデルクラスファイル読み込み
require_once __DIR__ . '/../model/gakuseiEditModel.php';
// データベースクラスファイル読み込み
require_once __DIR__ . '/../model/dbManager.php';


// データベース管理クラス生成
$myDb = new DbManager();

    // 変更ボタンが押された場合
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['gakusei-edit-btn'])) {
        // 入力値取得
        $gakuseiId = $_POST['edit-gakusei-id'];
        $productName = $_POST['edit-product-name'];
        $gakuseiCount = $_POST['edit-gakusei-count'];

        // モデルインスタンス生成
        $gakuseiEditModel = new gakuseiEditModel((int)$gakuseiId, $productName, (int)$gakuseiCount);

        // 学生更新
        if (empty($var)) {
            $var = $gakuseiEditModel->updateGakuseiInfomation($myDb);
        }

        // 学生更新に成功した場合
        if (empty($var)) {
            // JavaScriptのポップアップでメッセージを表示
            echo '<script type="text/javascript">alert("学生情報を更新しました");</script>';
        }
    }    else {
        // GET値から学生IDを取得
        $gakuseiId = $_GET['sid'];
        // モデルインスタンス生成
        $gakuseiEditModel = new GakuseiEditModel((int)$gakuseiId);
        // 学生IDから学生情報取得
        $gakuseiInfo = $gakuseiEditModel->getGakuseiInfomation($myDb);
        if(empty($var)) {
            //変数に値をセットする
            $productName = $gakuseiInfo[0]['product_name'];
            $gakuseiCount = $gakuseiInfo[0]['gakusei_count'];
        }
    }
    
   








// 学生編集テンプレートファイル読み込み
include_once __DIR__ . '/../view/gakuseiEditView.php';

<?php

// 学生削除モデルクラスファイル読み込み
require_once __DIR__ . '/../model/gakuseiDeleteModel.php';
// データベースクラスファイル読み込み
require_once __DIR__ . '/../model/dbManager.php';

    // データベース管理クラス生成
    $myDb = new DbManager();

    // POST通信の場合
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 削除確認で「はい」ボタンが押された場合
        if (isset($_POST['gakusei-delete-btn'])) {
            // 入力値取得
            $gakuseiId = $_POST['delete-gakusei-id'];
            // モデルインスタンス生成
            $gakuseiDeleteModel = new GakuseiDeleteModel((int)$gakuseiId);

            // 削除処理
            $msg = $gakuseiDeleteModel->deleteGakusei($myDb);

            // 学生削除に成功した場合
            if (empty($msg)) {
                $msg = "学生情報を削除しました";
            } else {
                // 学生削除に失敗した場合
                $msg = "学生情報の削除に失敗しました";
            }
            
        } else if (isset($_POST['gakusei-non-delete-btn'])) {
            // 削除確認で「いいえ」ボタンが押された場合
            // 学生一覧画面へ移動
            header('Location:./gakusei-list.php');
            exit();
        }
        
    } else {
        // POST通信以外の場合
        // GET値が存在しない場合
        if(!isset($_GET['sid'])) {
            $msg = "不正なアクセスです";
            
        } else {
            // GET値が存在する場合
            // GET値から学生IDを取得
            $gakuseiId = $_GET['sid'];
        
            // モデルインスタンス生成
            $gakuseiDeleteModel = new GakuseiDeleteModel((int)$gakuseiId);
            // 学生IDから学生情報取得
            $gakuseiInfo = $gakuseiDeleteModel->getGakuseiInfomation($myDb);
        
            // 学生情報がnull、もしくは空の場合
            if(is_null($gakuseiInfo) || count($gakuseiInfo) === 0) {
                $msg = "学生情報の取得に失敗しました";
                
            } else {
                // 学生情報が存在する場合、変数に値をセット
                $productName = $gakuseiInfo[0]['product_name'];
                $gakuseiCount = $gakuseiInfo[0]['gakusei_count'];
            }
        }
}

// 学生削除テンプレートファイル読み込み
include_once __DIR__ . '/../view/gakuseiDeleteView.php';

<?php

// 成績削除モデルクラスファイル読み込み
require_once __DIR__ . '/../model/shippSchDeleteModel.php';
// データベースクラスファイル読み込み
require_once __DIR__ . '/../model/dbManager.php';

// データベース管理オブジェクト
$myDb = null;
// 表示メッセージ
$msg = "";
// 成績ID
$shippSchId = null;


    // データベース管理クラス生成
    $myDb = new DbManager();

    // POST通信の場合
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 削除確認で「はい」ボタンが押された場合
        if (isset($_POST['shipp-sch-delete-btn'])) {
            // 入力値取得
            $shippSchId = $_POST['delete-shipp-sch-id'];
            // モデルインスタンス生成
            $shippSchDeleteModel = new ShippSchDeleteModel((int)$shippSchId);

            // 削除処理
            $msg = $shippSchDeleteModel->deleteShippSch($myDb);

            // 成績削除に成功した場合
            if (empty($msg)) {
                $msg = "成績を削除しました";
            } else {
                // 成績削除に失敗した場合
                $msg = "成績の削除に失敗しました";
            }
            
        } else if (isset($_POST['shipp-sch-non-delete-btn'])) {
            // 削除確認で「いいえ」ボタンが押された場合
            // 成績一覧画面へ移動
            header('Location:./shipp-sch-list.php');
            exit();
        }
        
    } else {
        // POST通信以外の場合
        // GET値が存在しない場合
        if(!isset($_GET['spid'])) {
            $msg = "不正なアクセスです";
            
            // 成績削除テンプレートファイル読み込んで、以降の処理を行わない
            include_once __DIR__ . '/../view/shippSchDeleteView.php';
            exit();
            
        } else {
            // GET値が存在する場合
            // GET値から成績IDを取得
            $shippSchId = $_GET['spid'];
        
            // モデルインスタンス生成
            $shippSchDeleteModel = new ShippSchDeleteModel((int)$shippSchId);
            // 成績IDから成績情報取得
            $shippSchInfo = $shippSchDeleteModel->getShippSchInfomation($myDb);
        
            // 成績情報がnull、もしくは空の場合
            if(is_null($shippSchInfo) || count($shippSchInfo) === 0) {
                $msg = "成績の取得に失敗しました";
                
            } else {
                // 成績情報が存在する場合、変数に値をセット
                $schYMD = $shippSchInfo[0]['shipp_sch_ymd'];
                $productName = $shippSchInfo[0]['product_name'];
                $shippCount = $shippSchInfo[0]['shipp_count'];
            }
        }
    }


// 成績削除テンプレートファイル読み込み
include_once __DIR__ . '/../view/shippSchDeleteView.php';

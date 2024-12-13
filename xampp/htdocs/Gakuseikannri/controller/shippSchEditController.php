<?php

// 成績編集モデルクラスファイル読み込み
require_once __DIR__ . '/../model/shippSchEditModel.php';
// データベースクラスファイル読み込み
require_once __DIR__ . '/../model/dbManager.php';

// データベース管理オブジェクト
$myDb = null;

// テスト受講日
$shippSchYear = "";
$shippSchMonth = "";
$shippSchDay = "";

// テスト受講日ID
$shippSchId = null;
// 学生名
$productName = "";
// 点数
$shippCount = "";
// タイムゾーン
const TIME_ZONE = 'Asia/Tokyo';

    // データベース管理クラス生成
    $myDb = new DbManager();

    // POST通信で変更ボタンが押された場合
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['shipp-sch-edit-btn'])) {
        // 入力値取得
        $shippSchYear = $_POST['edit-sch-year'];
        $shippSchMonth = $_POST['edit-sch-month'];
        $shippSchDay = $_POST['edit-sch-day'];
        $shippSchId = $_POST['edit-shipp-sch-id'];
        $productName = $_POST['edit-product-name'];
        $shippCount = $_POST['edit-shipp-count'];

        // モデルインスタンス生成
        $shippSchEditModel = new ShippSchEditModel($shippSchYear, $shippSchMonth, $shippSchDay, (int)$shippSchId, (int)$shippCount);

        // 入力値チェック
        $errorMsg = $shippSchEditModel->validationPostItems($myDb);

        // エラーがなければ成績更新
        if (empty($errorMsg)) {
            $errorMsg = $shippSchEditModel->updateShippSchInfomation($myDb);
        }

        // 成績更新に成功した場合
        if (empty($errorMsg)) {
            // JavaScriptのポップアップでメッセージを表示
            echo '<script type="text/javascript">alert("成績を更新しました");</script>';
        }
    }  else {
        // 変更処理以外の場合
        // GET値が存在しない場合
        if(!isset($_GET['spid'])) {
            $infoMsg = "不正なアクセスです";
        } else {
            // GET値が存在する場合
            // GET値から成績IDを取得
            $shippSchId = $_GET['spid'];
        
            // モデルインスタンス生成
            $shippSchEditModel = new ShippSchEditModel($shippSchYear, $shippSchMonth, $shippSchDay, (int)$shippSchId, (int)$shippCount);
            // 成績IDから成績情報取得
            $shippSchInfo = $shippSchEditModel->getShippSchInfomation($myDb);
        
            // 成績情報がnull、もしくは空の場合
            if(is_null($shippSchInfo) || count($shippSchInfo) === 0) {
                $infoMsg = "成績情報の取得に失敗しました";
                
            } else {
                // 成績情報が存在する場合
                //　テスト受講日から日付オブジェクトを取得
                $shippDateTimeObj = (new DateTime($shippSchInfo[0]['shipp_sch_ymd']))->setTimezone(new DateTimeZone(TIME_ZONE));
                
                // 変数に値をセット
                $shippSchYear = $shippDateTimeObj->format("Y");
                $shippSchMonth = $shippDateTimeObj->format("m");
                $shippSchDay = $shippDateTimeObj->format("d");
                $productName = $shippSchInfo[0]['product_name'];
                $shippCount = $shippSchInfo[0]['shipp_count'];
            }
        }
    }

// 成績編集テンプレートファイル読み込み
include_once __DIR__ . '/../view/shippSchEditEditView.php';

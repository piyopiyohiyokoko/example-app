<?php

// 成績新規登録モデルクラスファイル読み込み
require_once __DIR__ . '/../model/shippSchRegistrationModel.php';
// データベースクラスファイル読み込み
require_once __DIR__ . '/../model/dbManager.php';

// タイムゾーン
const TIME_ZONE = 'Asia/Tokyo';

// 現在年月日の取得
$nowDateTime = (new DateTime())->setTimezone(new DateTimeZone(TIME_ZONE));
$nowYear = $nowDateTime->format("Y");
$nowMonth = $nowDateTime->format("m");
$nowDay = $nowDateTime->format("d");

// テスト受講日
$shippSchYear = $nowYear;
$shippSchMonth = $nowMonth;
$shippSchDay = $nowDay;

// 学生名
$productName = "";
// 合計点数
$shippCount = "";



    // データベース管理クラス生成
    $myDb = new DbManager();

    // POST通信で登録ボタンが押された場合
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['shipp-sch-regist-btn'])) {
        // 入力値取得
        $shippSchYear = $_POST['regist-sch-year'];
        $shippSchMonth = $_POST['regist-sch-month'];
        $shippSchDay = $_POST['regist-sch-day'];
        $productName = $_POST['regist-product-name'];
        $shippCount = $_POST['regist-shipp-count'];
        
        // モデルインスタンス生成
        $shippSchRegistrationModel = new ShippSchRegistrationModel($shippSchYear, $shippSchMonth, $shippSchDay, $productName, (int)$shippCount);

        // エラーがなければ成績登録
        if (empty($Msg)) {
            $Msg = $shippSchRegistrationModel->registerShippSchInfomation($myDb);
        }

        // 成績登録に成功した場合
        if (empty($errorMsg)) {
            // JavaScriptのポップアップでメッセージを表示
            echo '<script type="text/javascript">alert("成績を登録しました");</script>';
           }
    } else {
        // 登録以外の場合
        // 各項目初期値の状態でモデルインスタンス生成
        $shippSchRegistrationModel = new ShippSchRegistrationModel($shippSchYear, $shippSchMonth, $shippSchDay, $productName, (int)$shippCount);
    }
    
    // 学生名リストを取得
    $productNameList = $shippSchRegistrationModel->getProductNameList($myDb);
    

// 成績新規登録テンプレートファイル読み込み
include_once __DIR__ . '/../view/shippSchRegistView.php';

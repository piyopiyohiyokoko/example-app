<?php

// 成績リストモデルクラスファイル読み込み
require_once __DIR__ . '/../model/shippSchListModel.php';
// データベースクラスファイル読み込み
require_once __DIR__ . '/../model/dbManager.php';


    // データベース管理クラス生成
    $myDb = new DbManager();
    // モデルインスタンス生成
    $shippSchListModel = new ShippSchListModel();
    
    // 全ての成績リスト取得
    $shippSchList = $shippSchListModel->getAllShippSchList($myDb);
    
    // 成績リストがnullの場合
    if(is_null($shippSchList)) {
        $infoMsg = "成績情報の検索に失敗しました";
    }

// 成績一覧テンプレートファイル読み込み
include_once __DIR__ . '/../view/shippSchListView.php';

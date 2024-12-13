<?php

// 学生リストモデルクラスファイル読み込み
require_once __DIR__ . '/../model/gakuseiListModel.php';
// データベースクラスファイル読み込み
require_once __DIR__ . '/../model/dbManager.php';

// 検学生名
$serachProductName = "";

    // データベース管理クラス生成
    $myDb = new DbManager();
    // モデルインスタンス生成
    $gakuseiListModel = new GakuseiListModel();
    
    // 昇順・降順ボタンが押された場合
    if (isset($_GET['sort'])) {
        // ソート順を取得
        $sort = 'ASC';
        if(in_array($_GET['sort'], ['ASC', 'DESC'])) {
            $sort = $_GET['sort'];
        }
        
        $serachProductName = $_GET['search'];
        
        // 指定した並び順でデータを取得
        $gakuseiList = $gakuseiListModel->getOrderGakuseiList($myDb, $sort, $serachProductName);
            
        // 学生リストが取得できた場合   
        if (is_null($gakuseiList) === false) {
            // 学生リスト表示
            foreach ($gakuseiList as $gakusei) {
                echo '<tr>';
                echo '<td>' . $gakusei['gakusei_id'] . '</td>';
                echo '<td>' . $gakusei['product_name'] . '</td>';
                echo '<td>' . $gakusei['gakusei_count'] . '</td>';
                echo '<td>';
                echo '<a href="./gakusei-edit.php?sid=' . $gakusei['gakusei_id'] . '"><button type="button">編集</button></a>';
                echo '<a href="./gakusei-delete.php?sid=' . $gakusei['gakusei_id'] . '"><button type="button">削除</button></a>';
                echo '</td>';
                echo '</tr>';
            }
        }
        return;
        
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['serach-btn'])) {
        // POST通信で検索ボタンが押された場合
        // 入力値取得
        $serachProductName = $_POST['serach-product-name'];
        
        // 検索条件から学生リストを取得
        if (empty($Msg)) {
            $gakuseiList = $gakuseiListModel->getSearchGakuseiList($myDb, $serachProductName);
            
            // 学生リストがnullの場合
            if(is_null($gakuseiList)) {
                $infoMsg = "学生情報の検索に失敗しました";
            }
        }
        
    } else {
        // 検索以外の場合
        // 全ての学生リスト取得
        $gakuseiList = $gakuseiListModel->getAllGakuseiList($myDb);
        
        // 学生リストがnullの場合
        if(is_null($gakuseiList)) {
            $infoMsg = "学生情報の取得に失敗しました";
        }
    }


// 学生一覧テンプレートファイル読み込み
include_once __DIR__ . '/../view/gakuseiListView.php';

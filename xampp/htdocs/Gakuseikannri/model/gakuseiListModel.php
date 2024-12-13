<?php

/**
 * 学生リストモデルクラス
 */
class GakuseiListModel {
    
    /**
     * コンストラクタ
     * 
     */
    public function __construct() {
    }
    
    
    /**
     * 入力チェック
     * 
     * @param String $serachProductName 検索学生名
     */
    public function validationPostItems(String $serachProductName): String {
        $msg = '';
        return $msg;
    }

    /**
     * 学生リスト取得
     * 
     * @param object $myDb DBオブジェクト
     * @return array 学生リスト(取得失敗時はnull)
     */
    public function getAllGakuseiList(object $myDb): array {
        // データベースから学生リストを取得
        $gakuseiList = $myDb->getAllGakuseiList();
        
        // 取得失敗時にはnullとする
        if($gakuseiList === false) {
            $gakuseiList = null;
        }
                
        return $gakuseiList;
    }
    
    /**
     * 検索対象学生リスト取得
     * 
     * @param object $myDb DBオブジェクト
     * @param String $serachProductName 検索学生名
     * @return array 検索結果学生リスト(取得失敗時はnull)
     */
    public function getSearchGakuseiList(object $myDb, String $serachProductName): array {
        // データベースから検索学生リストを取得
        $gakuseiList = $myDb->getSearchGakuseiList($serachProductName);
        
        // 取得失敗時にはnullとする
        if($gakuseiList === false) {
            $gakuseiList = null;
        }

        return $gakuseiList;
    }
    
    /**
     * ソート学生リスト取得
     * 
     * @param object $myDb DBオブジェクト
     * @param string $sort 並び順
     * @param string $serachProductName 検索学生名
     * @return array 検索結果学生リスト(取得失敗時はnull)
     */
    public function getOrderGakuseiList(object $myDb, string $sort, string $serachProductName): array {
        // データベースから検索学生リストを取得
        $gakuseiList = $myDb->getOrderGakuseiList($sort, $serachProductName);
        
        // 取得失敗時にはnullとする
        if($gakuseiList === false) {
            $gakuseiList = null;
        }

        return $gakuseiList;
    }
    
}

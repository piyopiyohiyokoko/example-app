<?php

/**
 * 成績リストモデルクラス
 */
class ShippSchListModel {
    
    /**
     * コンストラクタ
     * 
     */
    public function __construct() {
    }
    
    /**
     * 成績リスト取得
     * 
     * @param object $myDb DBオブジェクト
     * @return array 成績リスト(取得失敗時はnull)
     */
    public function getAllShippSchList(object $myDb): array {
        // データベースから成績リストを取得
        $gakuseiList = $myDb->getAllShippSchList();
        
        // 取得失敗時にはnullとする
        if($gakuseiList === false) {
            $gakuseiList = null;
        }
                
        return $gakuseiList;
    }
    
}

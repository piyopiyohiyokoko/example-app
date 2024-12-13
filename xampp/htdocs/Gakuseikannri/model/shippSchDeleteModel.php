<?php

/**
 * 成績削除モデルクラス
 */
class ShippSchDeleteModel {

    // 成績ID
    private int $shippSchId;
    
    /**
     * コンストラクタ
     * 
     * @param int $shippSchId 成績ID
     */
    public function __construct(int $shippSchId) {
        $this->shippSchId = $shippSchId;
    }

    /**
     * 成績削除
     * 
     * @param object $myDb データベースオブジェクト
     * @return string エラーメッセージ
     */
    public function deleteShippSch(object $myDb): string {
        $msg = '';

        // 成績情報削除
        if (!$myDb->deleteShippSchInfomation($this->shippSchId)) {
            // 削除失敗の場合エラーメッセージ設定
            $msg = "成績の削除に失敗しました";
        }

        return $msg;
    }
    
    /**
     * 成績情報取得
     * 
     * @param object $myDb DBオブジェクト
     * @return array 成績リスト(取得失敗時はnull)
     */
    public function getShippSchInfomation(object $myDb): array {
        // データベースから成績情報を取得
        $shippSchList = $myDb->getShippSchInfomationFromId($this->shippSchId);
        
        // 取得失敗時にはnullとする
        if($shippSchList === false) {
            $shippSchList = null;
        }

        return $shippSchList;
    }
    
}

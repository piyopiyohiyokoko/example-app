<?php

/**
 * 学生登録モデルクラス
 */
class GakuseiRegistrationModel {

    // 学生名
    private String $productName;
    // 学年
    private int $gakuseiCount;
    
    /**
     * コンストラクタ
     * 
     * @param String $productName 学生名
     * @param int $gakuseiCount 学年
     */
    public function __construct(String $productName, int $gakuseiCount) {
        $this->productName = $productName;
        $this->gakuseiCount = $gakuseiCount;
    }

    /**
     * 学生登録
     * 
     * @param object $myDb データベースオブジェクト
     * @return String エラーメッセージ
     */
    public function registerGakuseiInfomation(object $myDb): String {
        $msg = '';

        // 学生情報登録
        if (!$myDb->insertGakuseiInfomation($this->productName, $this->gakuseiCount)) {
            // 登録失敗の場合エラーメッセージ設定
            $msg = '学生登録に失敗しました';
        }

        return $msg;
    }    
}

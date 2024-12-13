<?php

/**
 * 成績登録モデルクラス
 */
class ShippSchRegistrationModel {

    /**
     * コンストラクタ
     * 
     * @param String $shippSchYear テスト受講年
     * @param String $shippSchMonth テスト受講月
     * @param String $shippSchDay テスト受講日
     * @param String $productName 学生名
     * @param int $shippCount 合計点数
     */
    public function __construct(String $shippSchYear, String $shippSchMonth, String $shippSchDay, String $productName, int $shippCount) {
        $this->shippSchYear = $shippSchYear;
        $this->shippSchMonth = $shippSchMonth;
        $this->shippSchDay = $shippSchDay;
        $this->productName = $productName;
        $this->shippCount = $shippCount;
    }


    /**
     * 成績新規登録
     * 
     * @param object $myDb データベースオブジェクト
     * @return String エラーメッセージ
     */
    public function registerShippSchInfomation(object $myDb): String {
        $msg = '';
        
        // テスト受講日を年月日(yyyymmdd)形式の文字列に変換
        $shippSchYMD = $this->shippSchYear . sprintf('%02d', $this->shippSchMonth) . sprintf('%02d', $this->shippSchDay);
        
        // テスト受講日登録
        if (!$myDb->insertShippSchInfomation($shippSchYMD, $this->productName, $this->shippCount)) {
            // 登録失敗の場合エラーメッセージ設定
            $msg = '学生成績登録に失敗しました';
        }

        return $msg;
    }
    
       /**
     * 学生名リスト取得
     * 
     * @param object $myDb DBオブジェクト
     * @return array 学生名リスト(取得失敗時はnull)
     */
    public function getProductNameList(object $myDb): array {
        // データベースから学生名リストを取得
        $gakuseiList = $myDb->getAllProductNameList();
        
        // 取得失敗時にはnullとする
        if($gakuseiList === false) {
            $gakuseiList = null;
        }
                
        return $gakuseiList;
    }
   
 }

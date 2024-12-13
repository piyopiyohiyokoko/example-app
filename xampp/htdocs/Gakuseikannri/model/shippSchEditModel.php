<?php

/**
 * 成績編集モデルクラス
 */
class ShippSchEditModel {

    /**
     * コンストラクタ
     * 
     * @param String $shippSchYear テスト受講年
     * @param String $shippSchMonth テスト受講月
     * @param String $shippSchDay テスト受講日
     * @param int $shippSchId 成績ID
     * @param int $shippCount 点数
     */
    public function __construct(String $shippSchYear, String $shippSchMonth, String $shippSchDay, int $shippSchId, int $shippCount = 0) {
        $this->shippSchYear = $shippSchYear;
        $this->shippSchMonth = $shippSchMonth;
        $this->shippSchDay = $shippSchDay;
        $this->shippSchId = $shippSchId;
        $this->shippCount = $shippCount;
    }

    /**
     * 入力チェック
     * エラーがない場合は空文字を返す
     * 
     * @param object $myDb データベースオブジェクト
     */
    public function validationPostItems(object $myDb): String {
     
        // 入力範囲チェック
        if(empty($msg)) {
            $msg = $this->checkInputRange();
        }
        
        return $msg;
    }

    /**
     * 成績更新
     * 
     * @param object $myDb データベースオブジェクト
     */
    public function updateShippSchInfomation(object $myDb): String {
        $msg = '';

        // 出荷予定日を年月日(yyyymmdd)形式の文字列に変換
        $shippSchYMD = $this->shippSchYear . sprintf('%02d', $this->shippSchMonth) . sprintf('%02d', $this->shippSchDay);
        
        // 成績情報更新
        if (!$myDb->updateShippSchInfomation($this->shippSchId, $shippSchYMD, $this->shippCount)) {

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
    
       /**
     * 入力範囲チェック
     * 
     * @return String エラーメッセージ
     */
    private function checkInputRange(): String {
        $msg = '';
        
        // 現在年月日の取得
        $nowDateTime = (new DateTime())->setTimezone(new DateTimeZone(TIME_ZONE));
        // 現在年月日を年月日(yyyymmdd)形式の8桁数字に変換
        $nowYmd = (int)($nowDateTime->format("Ymd"));
        
        // テスト受講日を年月日(yyyymmdd)形式の8桁数字に変換
        $shippSchYMD = (int)($this->shippSchYear . sprintf('%02d', $this->shippSchMonth) . sprintf('%02d', $this->shippSchDay));

       
        
        return $msg;
    }
 
}
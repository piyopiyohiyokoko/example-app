<?php

/**
 * 学生編集モデルクラス
 */
class GakuseiEditModel {


    /**
     * コンストラクタ
     * 
     * @param int $gakuseiId 学生ID
     * @param String $productName 学生名
     * @param int $gakuseiCount 学年
     */
    public function __construct(int $gakuseiId, String $productName = "", int $gakuseiCount = 0) {
        $this->gakuseiId = $gakuseiId;
        $this->productName = $productName;
        $this->gakuseiCount = $gakuseiCount;
    }

    

    /**
     * 学生更新
     * 
     * @param object $myDb データベースオブジェクト
     */
    public function updateGakuseiInfomation(object $myDb): String {
        $msg = '';
        
        // 複数回データ更新を行うため、トランザクション処理を行う

            // トランザクション開始
            $myDb->beginTransaction();
            
            // 更新対象学生データの学生名更新
            $result = $myDb->updateShippSchProductNameFromGakuseiId($this->gakuseiId, $this->productName);
            
            // 成績一覧データ更新に成功した場合
            if($result === true) {
                // 学生情報更新
                $result = $myDb->updateGakuseiInfomation($this->gakuseiId, $this->productName, $this->gakuseiCount);
            }
            
            // 学生情報更新に成功した場合
            if ($result === true) {
                // コミット
                $myDb->commit();
            } else {
                // 更新処理に失敗した場合
                // 処理をロールバック
                $myDb->rollBack();
            }
            
        return $msg;
    }
    
    
/**
     * 学生情報取得
     * 
     * @param object $myDb DBオブジェクト
     * @return array 検索結果学生リスト(取得失敗時はnull)
     */
    public function getGakuseiInfomation(object $myDb): array {
        // データベースから学生情報を取得
        $gakuseiList = $myDb->getGakuseiInfomationFromId($this->gakuseiId);
        
        // 取得失敗時にはnull
        if($gakuseiList === false) {
            $gakuseiList = null;
        }

        return $gakuseiList;
    }
    
    
    
}


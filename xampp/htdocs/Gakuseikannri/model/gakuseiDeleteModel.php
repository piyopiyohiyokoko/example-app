<?php

/**
 * 学生削除モデルクラス
 */
class GakuseiDeleteModel {

    // 学生ID
    private int $gakuseiId;
    
    /**
     * コンストラクタ
     * 
     * @param int $gakuseiId 学生ID
     */
    public function __construct(int $gakuseiId) {
        $this->gakuseiId = $gakuseiId;
    }

    /**
     * 学生削除
     * 
     * @param object $myDb データベースオブジェクト
     */
    public function deleteGakusei(object $myDb): string {
        $msg = '';
        
        // 複数回データ削除を行うため、トランザクション処理を行う
        
            // トランザクション開始
            $myDb->beginTransaction();
            
            // 削除対象学生の成績データ削除
            $result = $myDb->deleteShippSchInfomationFromGakuseiId($this->gakuseiId);
            
            // 成績データ削除に成功した場合
            if($result === true) {
                // 学生情報削除
                $result = $myDb->deleteGakuseiInfomation($this->gakuseiId);
            }
            
            // 学生情報削除に成功した場合
            if ($result === true) {
                // コミット
                $myDb->commit();
            } else {
                // 削除処理に失敗した場合
                // 処理をロールバック
                $myDb->rollBack();
            }
        
        return $msg;
    }
    
    /**
     *学生情報取得
     * 
     * @param object $myDb DBオブジェクト
     * @return array 学生リスト(取得失敗時はnull)
     */
    public function getGakuseiInfomation(object $myDb): array {
        // データベースから学生情報を取得
        $gakuseiList = $myDb->getGakuseiInfomationFromId($this->gakuseiId);
        
        // 取得失敗時にはnullとする
        if($gakuseiList === false) {
            $gakuseiList = null;
        }

        return $gakuseiList;
    }
    
}

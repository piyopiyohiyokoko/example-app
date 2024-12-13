<?php

/**
 * ユーザーアカウント登録モデルクラス
 */
class UserRegistrationModel {

    // ログインID
    private String $loginId;
    // パスワード
    private String $password;

    /**
     * コンストラクタ
     * 
     * @param String $loginId ログインID
     * @param String $password パスワード
     */
    public function __construct(String $loginId, String $password) {
        $this->loginId = $loginId;
        $this->password = $password;
    }

    
    /**
     * ユーザアカウント登録
     * 
     * @param object $myDb データベースオブジェクト
     * @return String エラーメッセージ
     */
    public function registerUserInfomation(object $myDb): String {
        $msg = '';

        // ユーザ情報登録
        if (!$myDb->insertUserInfomation($this->loginId, $this->password)) 
        {
            // 登録失敗の場合エラーメッセージ設定
            $msg = 'アカウント登録に失敗しました';
        }
        return $msg;
    }
}
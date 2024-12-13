<?php

/**
 * ユーザログインモデルクラス
 */
class UserLoginModel {

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
     * 会員ログイン認証実行
     * 
     * @param object $myDb データベースオブジェクト
     * @return String エラーメッセージ
     */
    public function authenticationMenberLogin(object $myDb): String {
        // エラーメッセージ
        $ver = "";
        // ログイン認証結果
        $loginResult = false;

        // データベースから該当ユーザ情報を取得
        $dbResultArray = $myDb->getLoginUserInfomation($this->loginId);
        
        
        // ユーザが存在すればパスワード一致チェック
        if (count($dbResultArray) !== 0) {
            // パスワードが一致した場合
            if($this->password === $dbResultArray[0]['password']) {
                $loginResult = true;
            }
        }
          // ログイン失敗の場合エラーメッセージ設定
          if (!$loginResult) {
            $ver = 'ログインに失敗しました';
        }

        return $ver;
    }


    }
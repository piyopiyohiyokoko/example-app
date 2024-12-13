<?php

/**
 * データベース管理クラス
 */
class DbManager {

    private string $host = "localhost";
    private string $dbName = "gakusei_management";
    private string $user = "root";
    private string $password = "";

    // データベースオブジェクト
    private object $db;

    /**
     * コンストラクタ
     */
    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbName};charser=utf8";
        $db = new PDO($dsn, $this->user, $this->password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db = $db;
    }

    /**
     * データベース接続を切る
     */
    public function dbClose() {
        unset($this->db);
    }
    
    /**
     * トランザクション開始
     */
    public function beginTransaction() {
        $this->db->beginTransaction();
    }
    
    /**
     * トランザクションコミット
     */
    public function commit() {
        $this->db->commit();
    }
    
    /**
     * トランザクションロールバック
     */
    public function rollBack() {
        $this->db->rollBack();
    }

    /**
     * ログインユーザアカウント登録
     * 
     * @param String $loginId ログインID
     * @param String $password パスワード
     * @return bool 実行結果(成功：true/失敗：false)
     */
    public function insertUserInfomation(String $loginId, String $password): bool {
        // SQLの作成
        $sql = 'INSERT INTO user_account(login_id, password) VALUES (?, ?)';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, $loginId);
        $stt->bindValue(2, $password);

        // SQLを実行 成功ならtrue 失敗ならfalse
        $result = $stt->execute();

        return $result;
    }
    
    /**
     * ログインユーザ情報取得
     * 
     * @param String $loginId ログインID
     * @return array | bool ユーザ情報配列(取得失敗時はfalse)
     */
    public function getLoginUserInfomation(String $loginId): array | bool {
        // SQLの作成
        $sql = 'SELECT * FROM user_account WHERE login_id = ?';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, $loginId);
        // SQLを実行
        $result = $stt->execute();
        
        // 実行結果が失敗した場合
        if($result === false) {
            return false;
        } else {
            // SQL実行が成功した場合、ログインユーザ情報を配列で返す
            return $stt->fetchAll();
        }
    }

    /**
     * 学生リスト取得
     * 
     * @return array | bool 学生リスト配列(取得失敗時はfalse)
     */
    public function getAllGakuseiList(): array | bool {
        // SQL作成
        $sql = 'SELECT * FROM gakusei';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // SQLの実行
        $result = $stt->execute();

        // 実行結果が失敗の場合
        if($result === false) {
            return false;
        } else {
            // SQL実行が成功した場合、学生情報を配列で返す
            return $stt->fetchAll();
        }
    }

    /**
     * 検索対象学生リスト取得
     * 
     * @param String $serachProductName 検索学生名
     * @return array | bool 検索結果学生リスト(取得失敗時はfalse)
     */
    public function getSearchGakuseiList(String $serachProductName): array | bool {
        // SQLの作成
        $sql = 'SELECT * FROM gakusei WHERE product_name LIKE ?';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, '%' . $serachProductName . '%');
        // SQLの実行
        $stt->execute();

        // 学生リストを返す
        return $stt->fetchAll();
    }

    /**
     * ソート学生リスト取得
     * 
     * @param string $sort 並び順
     * @param string $serachProductName 検索学生名
     * @return array | bool 検索結果学生リスト(取得失敗時はfalse)
     */
    public function getOrderGakuseiList(string $sort, string $serachProductName): array | bool {
        // SQLの作成
        $sql = 'SELECT * FROM gakusei WHERE product_name LIKE ? ORDER BY gakusei_count ' . $sort;
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, '%' . $serachProductName . '%');
        // SQLの実行
        $stt->execute();

        // 学生リストを返す
        return $stt->fetchAll();
    }
    
    /**
     * 学生情報取得
     * 
     * @param String $productName 学生名
     * @return array | bool 学生情報配列(取得失敗時はfalse)
     */
    public function getGakuseiInfomation(String $productName): array | bool {
        // SQLの作成
        $sql = 'SELECT * FROM gakusei WHERE product_name = ?';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, $productName);
        // SQLを実行
        $result = $stt->execute();
        
        // 実行結果が失敗した場合
        if($result === false) {
            return false;
        } else {
            // SQL実行が成功した場合、学生情報を配列で返す
            return $stt->fetchAll();
        }
    }
    
    /**
     * 学生情報登録
     * 
     * @param String $productName 学生名
     * @param int $gakuseiCount 学年
     * @return bool 実行結果(成功：true/失敗：false)
     */
    public function insertGakuseiInfomation(String $productName, int $gakuseiCount): bool {
        // SQLの作成
        $sql = 'INSERT INTO gakusei(product_name, gakusei_count) VALUES (?, ?)';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, $productName);
        $stt->bindValue(2, $gakuseiCount);

        // SQLを実行 成功ならtrue 失敗ならfalse
        $result = $stt->execute();

        return $result;
    }
    
    /**
     * 編集用学生情報取得
     * 指定した学生ID以外で、指定した学生名の学生情報を取得する
     * 
     * @param int $gakuseiId 学生ID
     * @param String $productName 学生名
     * @return array | bool 学生情報配列(取得失敗時はfalse)
     */
    public function getGakuseiEditInfomation(int $gakuseiId, String $productName): array | bool {
        // SQLの作成
        $sql = 'SELECT * FROM gakusei WHERE product_name = ? AND gakusei_id <> ?';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, $productName);
        $stt->bindValue(2, $gakuseiId);
        // SQLを実行
        $result = $stt->execute();
        
        // 実行結果が失敗した場合
        if($result === false) {
            return false;
        } else {
            // SQL実行が成功した場合、学生情報を配列で返す
            return $stt->fetchAll();
        }
    }
    
    /**
     * 学生情報更新
     * 
     * @param int $gakuseiId 学生ID
     * @param String $productName 学生名
     * @param int $gakuseiCount 学年
     * @return bool 実行結果(成功：true/失敗：false)
     */
    public function updateGakuseiInfomation(int $gakuseiId, String $productName, int $gakuseiCount): bool {
        // SQLの作成
        $sql = 'UPDATE gakusei set product_name = ?, gakusei_count = ? WHERE gakusei_id = ?';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, $productName);
        $stt->bindValue(2, $gakuseiCount);
        $stt->bindValue(3, $gakuseiId);

        // SQLを実行 成功ならtrue 失敗ならfalse
        $result = $stt->execute();

        return $result;
    }
    
    /**
     * 学生情報取得(学生ID)
     * 
     * @param int $gakuseiId 学生ID
     * @return array | bool 学生情報配列(取得失敗時はfalse)
     */
    public function getGakuseiInfomationFromId(int $gakuseiId): array | bool {
        // SQLの作成
        $sql = 'SELECT * FROM gakusei WHERE gakusei_id = ?';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, $gakuseiId);
        // SQLを実行
        $result = $stt->execute();
        
        // 実行結果が失敗した場合
        if($result === false) {
            return false;
        } else {
            // SQL実行が成功した場合、学生情報を配列で返す
            return $stt->fetchAll();
        }
    }
    
    /**
     * 学生情報削除
     * 
     * @param int $gakuseiId 学生ID
     * @return bool 実行結果(成功：true/失敗：false)
     */
    public function deleteGakuseiInfomation(int $gakuseiId): bool {
        // SQLの作成
        $sql = 'DELETE FROM gakusei WHERE gakusei_id = ?';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, $gakuseiId);

        // SQLを実行 成功ならtrue 失敗ならfalse
        $result = $stt->execute();

        return $result;
    }
    
    /**
     * 成績リスト取得
     * 
     * @return array | bool 成績リスト配列(取得失敗時はfalse)
     */
    public function getAllShippSchList(): array | bool {
        // SQL作成
        $sql = 'SELECT * FROM shipping_schedule order by shipp_sch_ymd desc';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // SQLの実行
        $result = $stt->execute();

        // 実行結果が失敗の場合
        if($result === false) {
            return false;
        } else {
            // SQL実行が成功した場合、成績情報を配列で返す
            return $stt->fetchAll();
        }
    }
    
    /**
     * 成績情報登録
     * 
     * @param String $shippSchYMD テスト受講日
     * @param String $productName 学生名
     * @param int $shippCount 点数
     * @return bool 実行結果(成功：true/失敗：false)
     */
    public function insertShippSchInfomation(String $shippSchYMD, String $productName, int $shippCount): bool {
        // SQLの作成
        $sql = 'INSERT INTO shipping_schedule(shipp_sch_ymd, product_name, shipp_count) VALUES (?, ?, ?)';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, $shippSchYMD);
        $stt->bindValue(2, $productName);
        $stt->bindValue(3, $shippCount);

        // SQLを実行 成功ならtrue 失敗ならfalse
        $result = $stt->execute();

        return $result;
    }
    
    /**
     * 学生名リスト取得
     * 
     * @return array | bool 学生名リスト配列(取得失敗時はfalse)
     */
    public function getAllProductNameList(): array | bool {
        // SQL作成
        $sql = 'SELECT product_name FROM gakusei';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // SQLの実行
        $result = $stt->execute();

        // 実行結果が失敗の場合
        if($result === false) {
            return false;
        } else {
            // SQL実行が成功した場合、学生名を配列で返す
            return $stt->fetchAll();
        }
    }
    
    /**
     * 成績情報更新
     * 
     * @param int $shippSchId 成績ID
     * @param int $shippSchYMD テスト受講日
     * @param int $shippCount 点数
     * @return bool 実行結果(成功：true/失敗：false)
     */
    public function updateShippSchInfomation(int $shippSchId, String $shippSchYMD, int $shippCount): bool {
        // SQLの作成
        $sql = 'UPDATE shipping_schedule set shipp_sch_ymd = ?, shipp_count = ? WHERE shipp_sch_id = ?';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, $shippSchYMD);
        $stt->bindValue(2, $shippCount);
        $stt->bindValue(3, $shippSchId);

        // SQLを実行 成功ならtrue 失敗ならfalse
        $result = $stt->execute();

        return $result;
    }
    
    /**
     * 成績更新(学生ID)
     * 
     * @param int $gakuseiId 学生ID
     * @param int $productName 学生名
     * @return bool 実行結果(成功：true/失敗：false)
     */
    public function updateShippSchProductNameFromGakuseiId(int $gakuseiId, String $productName): bool {
        // SQLの作成
        $sql = 'UPDATE shipping_schedule set product_name = ? WHERE product_name = (SELECT product_name FROM gakusei WHERE gakusei_id = ?)';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, $productName);
        $stt->bindValue(2, $gakuseiId);

        // SQLを実行 成功ならtrue 失敗ならfalse
        $result = $stt->execute();

        return $result;
    }
    
    /**
     * 成績情報削除
     * 
     * @param int $shippSchId 成績ID
     * @return bool 実行結果(成功：true/失敗：false)
     */
    public function deleteShippSchInfomation(int $shippSchId): bool {
        // SQLの作成
        $sql = 'DELETE FROM shipping_schedule WHERE shipp_sch_id = ?';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, $shippSchId);

        // SQLを実行 成功ならtrue 失敗ならfalse
        $result = $stt->execute();

        return $result;
    }
    
    /**
     * 成績情報削除(学生ID)
     * 
     * @param int $gakuseiId 学生ID
     * @return bool 実行結果(成功：true/失敗：false)
     */
    public function deleteShippSchInfomationFromGakuseiId(int $gakuseiId): bool {
        // SQLの作成
        $sql = 'DELETE FROM shipping_schedule WHERE product_name = (SELECT product_name FROM gakusei WHERE gakusei_id = ?)';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, $gakuseiId);

        // SQLを実行 成功ならtrue 失敗ならfalse
        $result = $stt->execute();

        return $result;
    }
    
    /**
     * 成績情報取得(成績ID)
     * 
     * @param int $shippSchId 成績ID
     * @return array | 成績情報配列(取得失敗時はfalse)
     */
    public function getShippSchInfomationFromId(int $shippSchId): array | bool {
        // SQLの作成
        $sql = 'SELECT * FROM shipping_schedule WHERE shipp_sch_id = ?';
        // ステートメントを取得
        $stt = $this->db->prepare($sql);
        // バインド処理実行
        $stt->bindValue(1, $shippSchId);
        // SQLを実行
        $result = $stt->execute();
        
        // 実行結果が失敗した場合
        if($result === false) {
            return false;
        } else {
            // SQL実行が成功した場合、成績情報を配列で返す
            return $stt->fetchAll();
        }
    }
}

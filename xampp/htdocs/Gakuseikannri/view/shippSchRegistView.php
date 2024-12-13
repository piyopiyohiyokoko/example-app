<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>成績新規登録</title>
    </head>

    <body>
        <header>
            <nav>
                <div>
                    <p>
                        <a href="./logout.php"><button type="button">ログアウト</button></a>
                    </p>
                    <p>
                        <a href="./gakusei-list.php">学生一覧</a>
                        <a href="./gakusei-regist.php">学生新規登録</a>
                        <a href="./shipp-sch-list.php">成績一覧</a>
                        <a href="./shipp-sch-regist.php">成績新規登録</a>
                    </p>
                </div>
            </nav>
        </header>
        <hr />
        
        <div>
            <h1>成績新規登録</h1>
        </div>
        <div>
            <?php
            if (!empty($Msg)) {
                echo '<div role="alert">' . $Msg . '</div>';
            }
            ?>
            <form action="" method="post">
                <div>
                    <label>テスト受講日</label>
                    <input type="text"   name="regist-sch-year">年
                    <input type="text"   name="regist-sch-month" >月
                    <input type="text"  name="regist-sch-day" >日
                </div>
                <div>
                    <label>学生名</label>
                    <select name="regist-product-name">
                        <option value=""></option>
                        <?php
                        // 学生名リストからセレクトボックスを作成
                        foreach($productNameList as $product) {
                            $option = '<option value="' . $product['product_name'] . '" ';
                            
                            // 操作中の学生名と一致する場合
                            if($product['product_name'] === $productName) {
                                // 学生名を選択状態にする
                                $option = $option . 'selected ';
                            }
                            $option = $option . '>' . $product['product_name'] . '</option>';
                            
                            echo $option;
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label>合計点数</label>
                    <input type="text" name="regist-shipp-count">
                </div>
                <input type="submit" name="shipp-sch-regist-btn" value="登録">
            </form>
        </div>
    </body>
</html>
</html>
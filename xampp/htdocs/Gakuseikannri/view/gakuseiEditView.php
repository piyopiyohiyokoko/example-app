<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>学生編集</title>
    </head>

    <body>
        <header>
            <nav>
                <div>
                    <!--ログアウトボタン-->
                    <p>
                        <a href="./logout.php"><button type="button">ログアウト</button></a>
                    </p>
                    <!--押した場所へ移動する-->
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
            <h1>学生編集</h1>
        </div>
            <!--編集画面-->
            <form action="" method="post">
                <input type="hidden" name="edit-gakusei-id" value="<?php echo $gakuseiId; ?>">
                <div>
                    <label>学生名</label>
                    <input type="text" name="edit-product-name" 
                           value="<?php echo $productName; ?>">
                </div>
                <div>
                    <label>学年</label>
                    <input type="number" name="edit-gakusei-count" 
                           value="<?php echo $gakuseiCount; ?>">
                </div>
                <!--変更ボタン-->
                <input type="submit" name="gakusei-edit-btn" value="変更">
            </form>
        </div>
    </body>
</html>
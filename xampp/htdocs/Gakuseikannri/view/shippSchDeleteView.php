<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="utf-8">
        <title>成績削除</title>
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

        <div>
            <h1>成績削除確認</h1>
        </div>
        <div>
            <?php
            if (!empty($msg)) {
                // メッセージがあればメッセージのみ表示
                echo '<div>' . $msg . '</div>';
            } else {
                // メッセージがなければ削除対象の成績情報を表示
            ?>
            <form action="" method="post">
                <input type="hidden" name="delete-shipp-sch-id" value="<?php echo $shippSchId; ?>">
                <div>
                    <p>テスト受講日： <?php echo $schYMD; ?></p>
                    <p>学生名　　　： <?php echo $productName; ?></p>
                    <p>点数　　： <?php echo $shippCount; ?></p>
                    <p>を本当に削除してよろしいでしょうか？</p>
                </div>
                <div>
                    <input type="submit" name="shipp-sch-non-delete-btn" value="いいえ">
                </div>
                <div>
                    <input type="submit" name="shipp-sch-delete-btn" value="はい">
                </div>
            </form>
            <?php
            }
            ?>
        </div>

    </body>

</html>
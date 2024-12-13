<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="utf-8">
        <title>学生削除</title>
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
            <h1>学生削除確認</h1>
        </div>
        <div>
            <?php
            if (!empty($msg)) {
                // メッセージがあればメッセージのみ表示
                echo '<div>' . $msg . '</div>';
            } else {
                // メッセージがなければ削除対象の学生情報を表示
            ?>
            <form action="" method="post">
                <input type="hidden" name="delete-gakusei-id" value="<?php echo $gakuseiId; ?>">
                <div>
                    <p>学生ID： <?php echo $gakuseiId; ?></p>
                    <p>学生名　： <?php echo $productName; ?></p>
                    <p>学年： <?php echo $gakuseiCount; ?></p>
                    <p>を本当に削除してよろしいでしょうか？</p>
                </div>
                <div>
                    <input type="submit" name="gakusei-non-delete-btn" value="いいえ">
                </div>
                <div>
                    <input type="submit" name="gakusei-delete-btn" value="はい">
                </div>
            </form>
            <?php
            }
            ?>
        </div>

    </body>

</html>
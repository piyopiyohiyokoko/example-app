<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>学生新規登録</title>
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
            <h1>学生新規登録</h1>
        </div>
        <div>
            <form action="" method="post">
                <div>
                    <label>学生名</label>
                    <input type="text" name="regist-product-name">
                </div>
                <div>
                    <label>学年</label>
                    <input type="number" name="regist-gakusei-count">
                </div>
                <input type="submit" name="gakusei-regist-btn" value="登録">
            </form>
        </div>
    </body>
</html>
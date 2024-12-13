
<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="utf-8">
        <title>成績一覧</title>
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
            <h1>成績一覧</h1>
        </div>
        <div>
            <?php
            if (!empty($infoMsg)) {
                // 表示用メッセージがあればメッセージのみ表示
                echo '<div>' . $infoMsg . '</div>';
            } else {
                // メッセージがなければ成績リストを表示
            ?>
            <table>
                <thead>
                    <tr>
                        <th>テスト受講日</th>
                        <th>学生名</th>
                        <th>点数</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($shippSchList as $shipp) {
                        echo '<tr>';
                        echo '<td>' . $shipp['shipp_sch_ymd'] . '</td>';
                        echo '<td>' . $shipp['product_name'] . '</td>';
                        echo '<td>' . $shipp['shipp_count'] . '</td>';
                        echo '<td>';
                    // 成績の編集と削除
                    if ($shipp['shipp_sch_ymd'] ) {
                        echo '<a href="./shipp-sch-edit.php?spid=' . $shipp['shipp_sch_id'] . '"><button type="button">編集</button></a>';
                    }
                    echo '<a href="./shipp-sch-delete.php?spid=' . $shipp['shipp_sch_id'] . '"><button type="button">削除</button></a>';
                    echo '</td>';
                    echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <?php
            }
            ?>
        </div>

    </body>

</html>
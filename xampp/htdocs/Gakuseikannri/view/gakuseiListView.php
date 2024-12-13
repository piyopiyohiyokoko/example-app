
<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="utf-8">
        <title>学生一覧</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        <a href="./shipp-sch-regist.php">成績登録</a>
                    </p>
                </div>
            </nav>
        </header>
        <hr />
        
        <div>
            <h1>学生一覧</h1>
        </div>
        <div>
        <?php
            if (!empty($Msg)) {
                    echo '<div role="alert">' . $Msg . '</div>';
                }else{
            ?>
            <div>
                <form action="" method="post">
                    <div >
                        <label>学生名</label>
                            <input type="text" name="serach-product-name" id="serach-product-name" 
                                   value="<?php echo $serachProductName; ?>">
                    </div>
                    <div>
                        <button type="submit" name="serach-btn">検索</button>
                    </div>
                </form>
                <button type="submit" id="ascBtn" name="order-asc-btn">昇順</button>
                <button type="submit" id="descBtn" name="order-desc-btn">降順</button>
            </div>

            <div>
                <table>
                    <thead>
                        <tr>
                            <th>学生名</th>
                            <th>学年</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="data-list">
                        <?php
                        foreach ($gakuseiList as $gakusei) {
                            echo '<tr>';
                            echo '<td>' . $gakusei['product_name'] . '</td>';
                            echo '<td>' . $gakusei['gakusei_count'] . '</td>';
                            echo '<td>';
                            echo '<a href="./gakusei-edit.php?sid=' . $gakusei['gakusei_id'] . '"><button type="button">編集</button></a>';
                            echo '<a href="./gakusei-delete.php?sid=' . $gakusei['gakusei_id'] . '"><button type="button">削除</button></a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            }
            ?>
        </div>

        <script>
        // Ajaxでデータを取得する関数
        function loadData(order) {
            var searchProduct = $('#serach-product-name').val();
            
            $.ajax({
                url: './controller/gakuseiListController.php',  // PHPファイルへのリクエスト
                type: 'GET',
                data: { sort: order,
                        search: searchProduct}  // 並び順をパラメータとして送信
            }).done(function(data) {
                $('#data-list').html(data);  // データ表示エリアを更新
            });
        }

        // 昇順ボタンがクリックされたとき
        $('#ascBtn').click(function() {
            loadData('ASC');
        });

        // 降順ボタンがクリックされたとき
        $('#descBtn').click(function() {
            loadData('DESC');
        });

        // 初期表示で昇順にデータをロード
//         loadData('ASC');
        </script>
    </body>

</html>
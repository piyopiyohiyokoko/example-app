<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>成績編集</title>
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
            <h1>成績編集</h1>
        </div>
        <div>
        <?php
           if (!empty($Msg)) {
                echo '<div role="alert">' . $Msg . '</div>';
            }else{
            ?>
                <form action="" method="post">
                    <input type="hidden" name="edit-shipp-sch-id" value="<?php echo $shippSchId; ?>">
                    <input type="hidden" name="edit-product-name" value="<?php echo $productName; ?>">
                <div class="form-group">
                    <label>テスト受講日</label>
                    <input type="text"name="edit-sch-year"  value="<?php echo $shippSchYear; ?>">年
                    <input type="text" name="edit-sch-month"  value="<?php echo $shippSchMonth; ?>">月
                    <input type="text" name="edit-sch-day" value="<?php echo $shippSchDay; ?>">日
                </div>
                <div>
                    <label>学生名</label>
                    <label><?php echo $productName; ?></label>
                </div>
                <div>
                    <label>点数</label>
                    <input type="number"  name="edit-shipp-count" 
                           value="<?php echo $shippCount; ?>">
                </div>
                <input type="submit" name="shipp-sch-edit-btn" value="変更">
            </form>
            <?php
            }
            ?>
        </div>
    </body>
</html>
<!DOCTYPE html>
<!--webページの内容が日本語であることの指定-->
<html lang="ja">

<head>
    <meta charset="utf-8">
    <!--ページのレイアウトをモバイル対応にするための指定-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--ブラウザのタブに表示されるページのタイトルを設定-->
    <title>学生一覧</title>

    <!--webページにjqueryを読み込むためのタグ。jqueryはJavaScriptのライブラリで、JavaScriptの記述を簡素化し、便利な機能を提供するもの。-->
    <!--<script>　このタグの中に、src属性を指定することで外部のJavaScriptファイルを読み込むことが出来る。-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div>
        <!--ブラウザのタブに表示されるページのタイトルを設定-->
        <h1>学生一覧</h1>
    </div>
    <div>
        <div>
            <div>
                <div>
                    <!--入力フィールドを説明するラベル。for="serach-student-name"と関連付けられている。-->
                    <label for="serach-student-name">学生名</label>
                    <!--type="text"　テキスト入力フィールドの指定-->
                    <!--name="serachName"　サーバーに送信される際の名前を指定-->
                    <!--id="serach-student-name"　ラベルと紐付けたり、CSSやJavaScriptで操作するための識別子-->
                    <input type="text" name="serachName" id="serach-student-name">
                </div>
                <div>
                    <!--入力フィールドを説明するラベル。for="serach-student-grade"と関連付けられている。-->
                    <label for="serach-student-grade">学年</label>
                    
                    <select name="serachGrade" id="serach-student-grade">
                        <option></option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                    </select>
                </div>
                <div>
                    <button type="submit" id="searchBtn" name="serach">検索</button>
                </div>
                <div>
                    <button type="submit" id="ascBtn" name="orderAsc">昇順</button>
                    <button type="submit" id="descBtn" name="orderDesc">降順</button>
                </div>
            </div>
        </div>

        <div>
            <table>
                <thead>
                    <tr>
                        <th>学年</th>
                        <th>名前</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="data-list">
                </tbody>
            </table>
        </div>

        <div>
            <a href="/menu"><button type="button">戻る</button></a>
        </div>
    </div>


    <!--JavaScriptの登録処理-->
        <script src="{{ asset('/js/displayList.js') }}"></script>
    
</body>

</html>
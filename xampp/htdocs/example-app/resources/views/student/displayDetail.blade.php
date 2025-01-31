<!DOCTYPE html>
<!--webページの内容が日本語であることの指定-->
<html lang="ja">

<head>
    <meta charset="utf-8">
    <!--ページのレイアウトをモバイル対応にするための指定-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--CSRF攻撃を防ぐために使用されるトークン-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--ブラウザのタブに表示されるページのタイトルを設定-->
    <title>学生詳細</title>

    <!--webページにjqueryを読み込むためのタグ。jqueryはJavaScriptのライブラリで、JavaScriptの記述を簡素化し、便利な機能を提供するもの。-->
    <!--<script>　このタグの中に、src属性を指定することで外部のJavaScriptファイルを読み込むことが出来る。-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div>
        <!--題名-->
        <h1>学生詳細</h1>
    </div>

    <div>
        <div>
            <!--題名-->
            <h3>【学生情報】</h3>
            @empty($student->toArray())
            <div>
                <!--配列のデータが空の場合、この文字が表示される-->
                学生情報未登録
            </div>

            <!--学生情報が存在する場合に実行される-->
            @else
            <div>
                <!--学年の表示--> 
                <label>学年: </label>
                <!--学生オブジェクトのgradeプロパティの値を表示する-->
                <label>{{ $student->grade }}</label>
            </div>

            <div>
                <!--名前の表示-->
                <label>名前: </label>
                <!--学生オブジェクトのnameプロパティの値を表示する-->
                <label>{{ $student->name }}</label>
            </div>

            <div>
                <!--住所の表示-->
                <label>住所: </label>
                <!--学生オブジェクトのaddressプロパティの値を表示する-->
                <label>{{ $student->address }}</label>
            </div>

            <div>
                <!--学生画像に表示をする-->
                <!-- $student->img_pathに画像が格納されてる-->
                <img src="/{{ $student->img_path }}" width="150px" height="auto" alt="顔写真">
            </div>

            <div>
                <!--コメントの表示-->
                <label>コメント: </label>
                <!--学生オブジェクトのcommentプロパティの値を表示する-->
                <label>{{ $student->comment }}</label>
            </div>
            <!--学生編集ボタン-->
            <!--$student->idは、編集ページのリンク-->
            <a href="/displayStudentEdit/{{ $student->id }}"><button type="button">学生編集</button></a>
            
            <!--学生削除ボタン-->
            <!--onclick="clickDeleteBtn()は、JavaScript関数のclickDeleteBtn（）を実行する-->
            <button type="button" onclick="clickDeleteBtn()">学生削除</button>
            <!--input type="hidden"で削除対象の学生IDを保持する-->
            <input type="hidden" id="delete-student-id" value="{{ $student->id }}">
            @endempty
        </div>

        <div>
            <!--題名-->
            <h3>【成績情報】</h3>
            <div>
                <div>
                    <label for="serach-grade">学年</label>
                    <!--name="serachGrade"　選択内容がフォーム送信時にサーバーへserachGradeという名前で送信される-->
                    <!--id="serach-grade"　ラベルと紐付けたり、CSSやJavaScriptで操作するための識別子-->
                    <select name="serachGrade" id="serach-grade">
                        <!--学年が選べる。ドロップダウンメニューの選択肢。-->
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                    </select>
                </div>

                <div>
                    <label for="serach-term">学期</label>
                    <!--name="serachTerm"　選択内容がフォーム送信時にサーバーへserachTermという名前で送信される-->
                    <!--id="serach-term"　ラベルと紐付けたり、CSSやJavaScriptで操作するための識別子-->
                    <select name="serachTerm" id="serach-term">
                        <!--学期が選べる。ドロップダウンメニューの選択肢。-->
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>

                <div>
                    <!--検索ボタン-->
                    <!--button type="submit"　このボタンを押すとフォームがサーバーに送信される-->
                    <!--id="searchBtn"　ラベルと紐付けたり、CSSやJavaScriptで操作するための識別子-->
                    <!--name="serach"　選択内容がフォーム送信時にサーバーへserachという名前で送信される-->
                    <button type="submit" id="searchBtn" name="serach">検索</button>
                </div>
            </div>
            <!--検索結果の表示。JavaScriptでデータを取得後、表示する。-->
            <div id="data-list">
            </div>

        </div>
        <div>
            <!--指定したリンク先のURLを動的に生成する-->
            <a href="/displaySchoolGradeCreate/{{ $student->id }}"><button type="button">成績追加</button></a>
            <!--戻るボタン。hrefで指定したリンクに移行する。-->
            <a href="/displayStudentList"><button type="button">戻る</button></a>
        </div>
    </div>

    <!--JavaScriptの登録処理-->
    <script src="{{ asset('/js/displayDetail.js') }}"></script>
</body>

</html>
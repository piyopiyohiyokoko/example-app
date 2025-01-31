<!DOCTYPE html>
<!--webページの内容が日本語であることの指定-->
<html lang="ja">

<head>
    <meta charset="utf-8">
    <!--ページのレイアウトをモバイル対応にするための指定-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--ブラウザのタブに表示されるページのタイトルを設定-->
    <title>学生登録</title>
</head>

<body>
    <div>
        <!--題名-->
        <h1>学生登録</h1>
    </div>
    <div>
        {{-- フラッシュメッセージの表示 --}}
        <!--成功メッセージをセッションから取得して表示-->
        @if (session('success'))
        <div>
            <!--成功メッセージをセッションから取得して表示-->
            {{ session('success') }}
        </div>
        @endif

        <!--入力にエラーがあるかチェックする。全てのエラーメッセージをリストで表示-->
        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <!--action="/createStudent"　データの送信先をcreateStudentに指定-->
        <!--method="post"　post通信に指定-->
        <!--enctype="multipart/form-data"　ファイルデータを含むフォームを送信する際に必要な設定-->
        <form action="/createStudent" method="post" enctype="multipart/form-data">

            <!--LaravelのCSRF対策用トークンを生成するための記述。このトークンがないと、サーバーは送信を拒否する。-->    
            @csrf

            <div>
                <!--入力フィールドを説明するラベル。for="student-name"と関連付けられている。-->
                <label for="student-name">名前</label>
                <!--type="text"　テキスト入力フィールドの指定-->
                <!--name="name"　サーバーに送信される際の名前を指定-->
                <!--id="student-name"　ラベルと紐付けたり、CSSやJavaScriptで操作するための識別子-->
                <!--autofocus　ページ読み込み時にこの入力欄に自動的にフォーカスがあたる-->
                <input type="text" name="name" id="student-name" autofocus>
            </div>
            <div>
                <!--入力フィールドを説明するラベル。for="student-address"と関連付けられている。-->
                <label for="student-address">住所</label>
                <!--type="text"　テキスト入力フィールドの指定-->
                <!--name="address"　サーバーに送信される際の名前を指定-->
                <!--id="student-address"　ラベルと紐付けたり、CSSやJavaScriptで操作するための識別子-->
                <input type="text" name="address" id="student-address">
            </div>
            <div>
                <!--入力フィールドを説明するラベル。for="student-img"と関連付けられている。-->
                <label for="student-img">顔写真</label>
                <!--type="file"　テキスト入力フィールドの指定-->
                <!--name="img"　サーバーに送信される際の名前を指定-->
                <!--id="student-img"　ラベルと紐付けたり、CSSやJavaScriptで操作するための識別子-->
                <!--accept="image/png, image/jpeg"　選択可能なファイル形式をPNGかJPEGに限定する-->
                <input type="file" name="img" id="student-img" accept="image/png, image/jpeg">
            </div>
            <div>
                <!--入力フィールドを説明するラベル。for="student-comment"と関連付けられている。-->
                <label for="student-comment">コメント</label>
                <!--textarea　ユーザーが福須堯のコメントを入力できるフィールドを定義-->
                <!--row="5"　行数の指定-->
                <!--cols="20"　文字数の幅を指定-->
                <!--name="comment"　サーバーに送信される際の名前を指定-->
                <!--id="student-comment"　ラベルと紐付けたり、CSSやJavaScriptで操作するための識別子-->
                <textarea row="5" cols="20" name="comment" id="student-comment"></textarea>
            </div>
            <!--input type="submit"　フォームのデータをサーバーに送信-->
            <!--name="create"　サーバーで送信データを識別するための名前-->
            <!--value="登録"　ボタンに表示される文字-->
            <input type="submit" name="create" value="登録" />
        </form>
        <div>
            <!--a href="/menu"　リンクの作成-->
            <!--button type="button"　クリックすると指定したリンク先に移動する-->
            <a href="/menu"><button type="button">戻る</button></a>
        </div>
    </div>
</body>

</html>
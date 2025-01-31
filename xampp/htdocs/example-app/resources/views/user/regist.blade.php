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
    <title>管理ユーザー新規登録</title>

    <!--webページにjqueryを読み込むためのタグ。jqueryはJavaScriptのライブラリで、JavaScriptの記述を簡素化し、便利な機能を提供するもの。-->
    <!--<script>　このタグの中に、src属性を指定することで外部のJavaScriptファイルを読み込むことが出来る。-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<!--ページの主要。テキストや画像、フォームなどが入る-->
<body>
    <div>
        <!--題名-->
        <h1>管理ユーザー新規登録</h1>
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

        <!--エラーメッセージが表示されるための場所-->
        <div id="error-messages"></div>

        <!--フォームデータをサーバーにpostリクエストとして送信する。-->
        <form method="post">
            <div>
                <!--入力フィールドを説明するラベル。for="user-name"と関連付けられている。-->
                <label for="user-name">ユーザ名</label>
                <!--type="text"　テキスト入力フィールドの指定-->
                <!--name="userName"　サーバーに送信される際の名前を指定-->
                <!--id="user-name"　ラベルと紐付けたり、CSSやJavaScriptで操作するための識別子-->
                <!--autofocus　ページ読み込み時にこの入力欄に自動的にフォーカスがあたる-->
                <input type="text" name="user_name" id="user-name" autofocus>
            </div>
            <div>
                <!--入力フィールドを説明するラベル。for="email"と関連付けられている。-->
                <label for="email">メールアドレス</label>
                <!--type="text"　テキスト入力フィールドの指定-->
                <!--name="email"　サーバーに送信される際の名前を指定-->
                <!--id="email"　ラベルと紐付けたり、CSSやJavaScriptで操作するための識別子-->
                <input type="text" name="email" id="email">
            </div>
            <div>
                <!--入力フィールドを説明するラベル。for="password"と関連付けられている。-->
                <label for="password">パスワード</label>
                <!--type="password"　テキスト入力フィールドの指定。伏字で表示される。-->
                <!--name="password"　サーバーに送信される際の名前を指定-->
                <!--id="password"　ラベルと紐付けたり、CSSやJavaScriptで操作するための識別子-->
                <input type="password" name="password" id="password">
            </div>
            <div>
                <!--入力フィールドを説明するラベル。for="password-confirm"と関連付けられている。-->
                <label for="password-confirm">パスワード(確認用)</label>
                <!--type="password"　テキスト入力フィールドの指定。伏字で表示される。-->
                <!--name="passwordConfirm"　サーバーに送信される際の名前を指定-->
                <!--id="password-confirm"　ラベルと紐付けたり、CSSやJavaScriptで操作するための識別子-->
                <input type="password" name="passwordConfirm" id="password-confirm">
            </div>

            <!--button type="button"　ボタン作成。フォーム送信ではなく、JavaScriptのコードを実行するボタン。-->
            <!--onclick="clickRegistBtn()"　clickRegistBtn（下記）で指定されたことを実行する。-->
            <button type="button" onclick="clickRegistBtn()">登録</button>
        </form>
    </div>

    <div>
        <!--戻るボタン。hrefで指定したリンクに移行する。-->
        <a href="/"><button type="button">戻る</button></a>
    </div>

    <!--JavaScriptの登録処理-->
    <script src="{{ asset('/js/regist.js') }}"></script>

</body>

</html>
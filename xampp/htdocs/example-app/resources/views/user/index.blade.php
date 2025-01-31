<!DOCTYPE html>
<!--webページの内容が日本語であることの指定-->
<html lang="ja">

<!--ページの基本情報-->
<head>
    <meta charset="utf-8">

<!--ページのレイアウトをモバイル対応にするための指定-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!--ブラウザのタブに表示されるページのタイトルを設定-->
    <title>管理ユーザーログイン</title>
</head>

<!--ページの主要。テキストや画像、フォームなどが入る-->
<body>
    <div>
        <!--題名-->
        <h1>管理ユーザーログイン</h1>
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

        <!--/loginのＵＲＬに送信-->
        <form action="/login" method="post">
        <!--LaravelのCSRF対策用トークンを生成するための記述。このトークンがないと、サーバーは送信を拒否する。-->    
        @csrf
            <div>
                <!--入力フィールドを説明するラベル。for="email"と関連付けられている。-->
                <label for="email">メールアドレス</label>
                <!--type="text"　テキスト入力フィールドの指定-->
                <!--name="email"　サーバーに送信される際の名前を指定-->
                <!--id="email"　ラベルと紐付けたり、CSSやJavaScriptで操作するための識別子-->
                <!--autofocus　ページ読み込み時にこの入力欄に自動的にフォーカスがあたる-->
                <input type="text" name="email" id="email" autofocus>
            </div>

            <div>
                <!--入力フィールドを説明するラベル。for="password"と関連付けられている。-->
                <label for="password">パスワード</label>
                <!--type="password"　テキスト入力フィールドの指定。伏字で表示される。-->
                <!--name="password"　サーバーに送信される際の名前を指定-->
                <!--id="password"　ラベルと紐付けたり、CSSやJavaScriptで操作するための識別子-->
                <input type="password" name="password" id="password">
            </div>
            <!--type="submit"　送信ボタン-->
            <!--name="login"　ボタンに名前を付けている。サーバー側でこの名前を識別する。-->
            <!--value="ログイン"　ボタンに表示されるテキスト-->
            <input type="submit" name="login" value="ログイン" />
        </form>
    </div>

    <div>
        <!--新規登録ボタンをクリックすると、新規登録ページへ移動-->
        <!--<a>タグはリンク作成に使う-->
        <a href="/displayRegist"><button type="button">新規登録</button></a>
    </div>
    
</body>

</html>
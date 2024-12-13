<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理ユーザーログイン</title>
</head>

<body>
    <div>
        <h1>管理ユーザーログイン</h1>
    </div>
    <div>
        {{-- フラッシュメッセージの表示 --}}
        @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="/login" method="post">
            @csrf
            <div>
                <label for="email">メールアドレス</label>
                <input type="text" name="email" id="email" autofocus>
            </div>
            <div>
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password">
            </div>
            <input type="submit" name="login" value="ログイン" />
        </form>
    </div>
    <div>
        <a href="/displayRegist"><button type="button">新規登録</button></a>
    </div>
    
</body>

</html>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>管理ユーザー新規登録</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div>
        <h1>管理ユーザー新規登録</h1>
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
        <div id="error-messages"></div>
        <form method="post">
            <div>
                <label for="user-name">ユーザ名</label>
                <input type="text" name="userName" id="user-name" autofocus>
            </div>
            <div>
                <label for="email">メールアドレス</label>
                <input type="text" name="email" id="email">
            </div>
            <div>
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <label for="password-confirm">パスワード(確認用)</label>
                <input type="password" name="passwordConfirm" id="password-confirm">
            </div>
            <button type="button" onclick="clickRegistBtn()">登録</button>
        </form>
    </div>
    <div>
        <a href="/"><button type="button">戻る</button></a>
    </div>

    <script>
        // 登録ボタン処理
        function clickRegistBtn() {
            // 入力値を取得
            var userName = $('#user-name').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var passwordConfirm = $('#password-confirm').val();

            $.ajax({
                url: '/regist',
                type: 'POST',
                data: {
                    regist: "regist",
                    userName: userName,
                    email: email,
                    password: password,
                    passwordConfirm: passwordConfirm,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // メッセージを表示
                    alert(response.message);
                    // 処理が成功の場合、ログイン画面へ
                    if (response.status == 200) {
                        var uri = new URL(window.location.href);
                        location.href = uri.origin;
                    }
                },
                error: function(xhr) {
                    var response = xhr.responseJSON;

                    if (response.errors) {
                        var errorMessages = '<ul>'; // <ul> タグで囲む
                        for (var field in response.errors) {
                            for (var i = 0; i < response.errors[field].length; i++) {
                                errorMessages += '<li>' + response.errors[field][i] + '</li>';
                            }
                        }
                        errorMessages += '</ul>'; // <ul> タグを閉じる
                        // エラー内容を画面に表示
                        $('#error-messages').html(errorMessages);
                    }
                }
            });
        }
    </script>
</body>

</html>
function clickRegistBtn() {
    // 入力値を取得
    var userName = $('#user-name').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var passwordConfirm = $('#password-confirm').val();

    //非同期リクエストの送信
    $.ajax({
        //リクエストを送信する最終的な場所（エンドポイント）のURL指定
        url: '/regist',
        //post通信の指定
        type: 'POST',
        //サーバーに送信するデータをオブジェクト形式で指定。
        //オブジェクト形式は、データを「キー・バリュー」のペアで整理する方法
        data: {
            regist: "regist",
            user_name: userName,
            email: email,
            password: password,
            passwordConfirm: passwordConfirm,
        },
        //セキュリティ対策。CSRF対策のため、トークンをリクエストヘッダーに追加。
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        //リクエストが成功した時
        success: function(response) {
            // メッセージを表示
            alert(response.message);
            // 処理が成功の場合、ログイン画面へ
            if (response.status == 200) {
                var uri = new URL(window.location.href);
                location.href = uri.origin;
            }
        },
        //リクエストが失敗した場合
        error: function(xhr) {
        //xhrオブジェクトからレスポンスのJSONデータを取得
            var response = xhr.responseJSON;

            //エラーチェック　サーバーから返されたデータ（response）にerrorsプロパティが存在するか確認。
            if (response.errors) {
                //エラーメッセージをリスト形式で表示するHTMLを動的に生成する。
                var errorMessages = '<ul>'; // <ul> タグで囲む
                for (var field in response.errors) {
                    for (var i = 0; i < response.errors[field].length; i++) {
                        errorMessages += '<li>' + response.errors[field][i] + '</li>';
                    }
                }
                errorMessages += '</ul>'; // <ul> タグを閉じる
                // エラーメッセージを画面に表示
                $('#error-messages').html(errorMessages);
            }
        }
    });
}
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>メニュー</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div>
            <h1>メニュー</h1>
        </div>
        <div>
            <form action="/menu" method="post">
                <button type="button" onclick="upSchoolYearBtn()">学年更新</button>
                <a href="/createStudent"><button type="button">学生登録</button></a>
                <a href="/displayStudentList"><button type="button">学生表示</button></a>
            </form>
        </div>

        
    <script>
        // 学年更新ボタン処理
        function upSchoolYearBtn() {
            // ポップアップを表示
            if (confirm('学年を更新してよいですか？')) {

                // OKが押された場合のみ処理を実行
                $.ajax({
                    url: '/upSchoolYear',
                    type: 'POST',
                    data: {
                        upSchoolYear: "upSchoolYear"
                    }, 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // メッセージを表示
                        alert(response.message);
                    },
                    error: function() {
                        alert(response.message);
                    }
                });
            }
        }
    </script>
    </body>
</html>

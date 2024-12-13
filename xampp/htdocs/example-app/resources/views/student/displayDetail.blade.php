<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>学生詳細</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div>
        <h1>学生詳細</h1>
    </div>

    <div>
        <div>
            <h3>【学生情報】</h3>
            @empty($student->toArray())
            <div>
                学生情報未登録
            </div>
            @else
            <div>
                <label>学年: </label>
                <label>{{ $student->grade }}</label>
            </div>
            <div>
                <label>名前: </label>
                <label>{{ $student->name }}</label>
            </div>
            <div>
                <label>住所: </label>
                <label>{{ $student->address }}</label>
            </div>
            <div>
                <img src="/{{ $student->img_path }}" width="150px" height="auto" alt="顔写真">
            </div>
            <div>
                <label>コメント: </label>
                <label>{{ $student->comment }}</label>
            </div>
            <a href="/displayStudentEdit/{{ $student->id }}"><button type="button">学生編集</button></a>
            <button type="button" onclick="clickDeleteBtn()">学生削除</button>
            <input type="hidden" id="delete-student-id" value="{{ $student->id }}">
            @endempty
        </div>
        <div>
            <h3>【成績情報】</h3>
            <div>
                <div>
                    <label for="serach-grade">学年</label>
                    <select name="serachGrade" id="serach-grade">
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
                    <select name="serachTerm" id="serach-term">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
                <div>
                    <button type="submit" id="searchBtn" name="serach">検索</button>
                </div>
            </div>

            <div id="data-list">
            </div>

        </div>
        <div>
            <a href="/displaySchoolGradeCreate/{{ $student->id }}"><button type="button">成績追加</button></a>
            <a href="/displayStudentList"><button type="button">戻る</button></a>
        </div>
    </div>

    <script>
        // Ajaxでデータを取得する関数
        function loadData() {
            var searchStudentId = $('#student-id').val();
            var searchGrade = $('#serach-grade').val();
            var searchTerm = $('#serach-term').val();

            $.ajax({
                // PHPファイルへのリクエスト
                url: '/displayStudentDetail/'.searchStudentId,
                type: 'GET',
                data: {
                    search: 'search',
                    studentId: searchStudentId,
                    grade: searchGrade,
                    term: searchTerm
                } // 並び順をパラメータとして送信
            }).done(function(data) {
                // データ表示エリアを更新
                $('#data-list').html(data);
            });
        }

        // 検索ボタンがクリックされたとき
        $('#searchBtn').click(function() {
            loadData();
        });

        // 初期表示でデータをロード
        loadData();

        // 学生削除ボタン処理
        function clickDeleteBtn() {
            // ポップアップを表示
            if (confirm('学生のデータを削除してよいですか？')) {
                // 学生IDを取得
                var deleteStudentId = $('#delete-student-id').val();

                // OKが押された場合のみ処理を実行
                $.ajax({
                    url: '/deleteStudent',
                    type: 'POST',
                    data: {
                        delete: "delete",
                        id: deleteStudentId
                    }, 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // メッセージを表示
                        alert(response.message);
                        // 処理が成功の場合、学生表示画面へ
                        if(response.status == 200) {
                            var uri = new URL(window.location.href);
                            location.href = uri.origin + "/displayStudentList";
                        }
                    },
                    error: function() {
                        alert(response.message);
                    }
                });
            }
        }

        // 成績削除ボタン処理
        function clickSchoolGradeDeleteBtn() {
            // ポップアップを表示
            if (confirm('対象の成績データを削除してよいですか？')) {
                // 成績IDを取得
                var deleteSchoolGradeId = $('#delete-grade-id').val();

                // OKが押された場合のみ処理を実行
                $.ajax({
                    url: '/deleteSchoolGrade',
                    type: 'POST',
                    data: {
                        delete: "deleteSchoolGrade",
                        id: deleteSchoolGradeId
                    }, 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // メッセージを表示
                        alert(response.message);
                        // 処理が成功の場合、再読み込み
                        if(response.status == 200) {
                            location.reload();
                        }
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
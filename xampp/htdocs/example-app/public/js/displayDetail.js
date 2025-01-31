function loadData() {
    // 入力値を取得
    var searchStudentId = $('#student-id').val();
    var searchGrade = $('#serach-grade').val();
    var searchTerm = $('#serach-term').val();

    //非同期リクエストの送信
    $.ajax({
        // PHPファイルへのリクエスト
        //リクエストを送信する最終的な場所（エンドポイント）のURL指定
        url: '/displayStudentDetail/'.searchStudentId,
        //get通信の指定
        type: 'GET',
        //サーバーに送信するデータをオブジェクト形式で指定。
        //オブジェクト形式は、データを「キー・バリュー」のペアで整理する方法
        data: {
            search: 'search',
            studentId: searchStudentId,
            grade: searchGrade,
            term: searchTerm
        } // 並び順をパラメータとして送信
    }).done(function(data) {
        if (Object.keys(data).length) {
            // データ表示エリアを更新
            $('#data-list').html(`
                <div>
                    <label>学期: </label>
                    <label>${data.term}</label>
                </div>
                <div>
                    <label>国語: </label>
                    <label>${data.japanese}</label>
                </div>
                <div>
                    <label>数学: </label>
                    <label>${data.math}</label>
                </div>
                <div>
                    <label>理科: </label>
                    <label>${data.science}</label>
                </div>
                <div>
                    <label>社会: </label>
                    <label>${data.social_studies}</label>
                </div>
                <div>
                    <label>音楽: </label>
                    <label>${data.music}</label>
                </div>
                <div>
                    <label>家庭科: </label>
                    <label>${data.home_economics}</label>
                </div>
                <div>
                    <label>英語: </label>
                    <label>${data.english}</label>
                </div>
                <div>
                    <label>美術: </label>
                    <label>${data.art}</label>
                </div>
                <div>
                    <label>保健体育: </label>
                    <label>${data.health_and_physical_education}</label>
                </div>
                <a href="/displaySchoolGradeEdit/${data.id}"><button type="button">成績編集</button></a>
                <button type="button" onclick="clickSchoolGradeDeleteBtn()">成績削除</button>
                <input type="hidden" id="delete-grade-id" value="${data.id}">
            `);
        } else {
            $('#data-list').html(`<div>検索条件に一致する成績情報はありません</div>`);
        }
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

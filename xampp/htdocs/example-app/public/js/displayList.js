function loadData(order) {
    var searchStudentName = $('#serach-student-name').val();
    var searchStudentGrade = $('#serach-student-grade').val();

    $.ajax({
        url: '/displayStudentList', // PHPファイルへのリクエスト
        type: 'GET',
        data: {
            sort: order,
            searchName: searchStudentName,
            searchGrade: searchStudentGrade
        } // 並び順をパラメータとして送信
    }).done(function(data) {
        // データを表示する前にテーブルをクリア
        $('#data-list').empty();

        // 結果がない場合のメッセージ
        if (data.length === 0) {
            $('#data-list').append('<tr><td colspan="3">検索結果がありません</td></tr>');
            return;
        }

        // データを表示
        for (let i = 0; i < data.length; i++) {
            let html = `
                <tr>
                    <td>${data[i].grade}</td>
                    <td>${data[i].name}</td>
                    <td>
                        <a href="/displayStudentDetail/${data[i].id}">
                            <button type="button">詳細表示</button>
                        </a>
                    </td>
                </tr>
            `;
            $('#data-list').append(html);
        }
    }).fail(function(xhr, status, error) {
        // エラー処理
        console.error("データ取得エラー:", error);
        $('#data-list').empty().append('<tr><td colspan="3">データの取得に失敗しました</td></tr>');
    });
}

// 検索ボタンがクリックされたとき
$('#searchBtn').click(function() {
    loadData('ASC');
});

// 昇順ボタンがクリックされたとき
$('#ascBtn').click(function() {
    loadData('ASC');
});

// 降順ボタンがクリックされたとき
$('#descBtn').click(function() {
    loadData('DESC');
});

// 初期表示で昇順にデータをロード
$(document).ready(function() {
    loadData('ASC');
});

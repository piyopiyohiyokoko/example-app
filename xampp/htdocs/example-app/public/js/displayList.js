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

        var html;
for (let i = 0; i < data.length; i++) {
html = `
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
            $('#data-list').append(html); // データ表示エリアを更新

}


        //$('#data-list').html(data); // データ表示エリアを更新
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
loadData('ASC');
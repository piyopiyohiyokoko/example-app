/**
 * 学年更新ボタン処理
 */
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

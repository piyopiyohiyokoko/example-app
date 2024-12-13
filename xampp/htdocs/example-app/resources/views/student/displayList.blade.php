<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>学生一覧</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div>
        <h1>学生一覧</h1>
    </div>
    <div>
        <div>
            <div>
                <div>
                    <label for="serach-student-name">学生名</label>
                    <input type="text" name="serachName" id="serach-student-name">
                </div>
                <div>
                    <label for="serach-student-grade">学年</label>
                    <select name="serachGrade" id="serach-student-grade">
                        <option></option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                    </select>
                </div>
                <div>
                    <button type="submit" id="searchBtn" name="serach">検索</button>
                </div>
                <div>
                    <button type="submit" id="ascBtn" name="orderAsc">昇順</button>
                    <button type="submit" id="descBtn" name="orderDesc">降順</button>
                </div>
            </div>
        </div>

        <div>
            <table>
                <thead>
                    <tr>
                        <th>学年</th>
                        <th>名前</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="data-list">
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->grade }}</td>
                        <td>{{ $student->name }}</td>
                        <td><a href="/displayStudentDetail/{{ $student->id }}"><button type="button">詳細表示</button></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <a href="/menu"><button type="button">戻る</button></a>
        </div>
    </div>

    <script>
        // Ajaxでデータを取得する関数
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
                $('#data-list').html(data); // データ表示エリアを更新
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
    </script>
</body>

</html>
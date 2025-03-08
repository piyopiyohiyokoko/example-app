<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>メニュー</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('js/menu.js') }}"></script>
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
    </body>
</html>

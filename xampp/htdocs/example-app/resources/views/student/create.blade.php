<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>学生登録</title>
</head>

<body>
    <div>
        <h1>学生登録</h1>
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
        <form action="/createStudent" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="student-name">名前</label>
                <input type="text" name="name" id="student-name" autofocus>
            </div>
            <div>
                <label for="student-address">住所</label>
                <input type="text" name="address" id="student-address">
            </div>
            <div>
                <label for="student-img">顔写真</label>
                <input type="file" name="img" id="student-img" accept="image/png, image/jpeg">
            </div>
            <div>
                <label for="student-comment">コメント</label>
                <textarea row="5" cols="20" name="comment" id="student-comment"></textarea>
            </div>
            <input type="submit" name="create" value="登録" />
        </form>
        <div>
            <a href="/menu"><button type="button">戻る</button></a>
        </div>
    </div>
</body>

</html>
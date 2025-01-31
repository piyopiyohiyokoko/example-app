<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>学生編集</title>
</head>

<body>
    <div>
        <h1>学生編集</h1>
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
        <form action="/editStudent" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="student-id" value="{{ $student->id }}">
            <input type="hidden" name="fileChangeFlg" id="file-change-flg" value="0">

            <div>
                <label>学生id </label>
                <label>{{ $student->id }}</label>
            </div>
            <div>
                <label for="student-grade">学年</label>
                <select name="grade" id="student-grade">
                    @for ($i = 1; $i <= 6; $i++)
                    <option value="{{ $i }}" {{ $i == $student->grade ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="student-name">名前</label>
                <input type="text" name="name" id="student-name" value="{{ $student->name }}" autofocus>
            </div>
            <div>
                <label for="student-address">住所</label>
                <input type="text" name="address" id="student-address" value="{{ $student->address }}">
            </div>
            <div>
                <label for="student-img">顔写真</label>
                <img src="/{{ $student->img_path }}" width="150px" height="auto" alt="顔写真" id="registered-img">
                <input type="file" name="img" id="student-img" accept="image/png, image/jpeg" style="display:none" onchange="fileChange()">
                <button id="file-select-btn" type="button">顔写真を変更</button><span id="file-name"></span>
            </div>
            <div>
                <label for="student-comment">コメント</label>
                <textarea row="5" cols="20" name="comment" id="student-comment">{{ $student->comment }}</textarea>
            </div>
            <input type="submit" name="edit" value="更新" />
        </form>
        <div>
            <a href="/displayStudentDetail/{{ $student->id }}"><button type="button">戻る</button></a>
        </div>
    </div>

    <script src="{{ asset('/js/edit.js') }}"></script>

</body>

</html>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>成績登録</title>
</head>

<body>
    <div>
        <h1>成績登録</h1>
    </div>

    {{-- フラッシュメッセージの表示 --}}
    @if (session('error'))
    <div>
        {{ session('error') }}
        <a href="/"><button type="button">トップへ戻る</button></a>
    </div>
    @else
    <div>
        <h4>【学生情報】</h4>
        <div>
            <label>学年: </label>
            <label>{{ $student->grade }}</label>
        </div>
        <div>
            <label>名前: </label>
            <label>{{ $student->name }}</label>
        </div>
        <hr>
    </div>
    <div>
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
        <form action="/createSchoolGrade" method="post">
            @csrf
            <input type="hidden" name="student_id" id="student_id" value="{{ $student->id }}">
            <div>
                <label for="grade">学年</label>
                <select name="grade" id="grade">
                    <option></option>
                    @for ($i = 1; $i <= $student->grade; $i++)
                        <option>{{$i}}</option>
                        @endfor
                </select>
            </div>
            <div>
                <label for="term">学期</label>
                <select name="term" id="term">
                    <option></option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
            <p></p>
            <div>
                <label for="japanese">国語</label>
                <select name="japanese" id="japanese">
                    <option></option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option>{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <div>
                <label for="math">数学</label>
                <select name="math" id="math">
                    <option></option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option>{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <div>
                <label for="science">理科</label>
                <select name="science" id="science">
                    <option></option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option>{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <div>
                <label for="social_studies">社会</label>
                <select name="social_studies" id="social_studies">
                    <option></option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option>{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <div>
                <label for="music">音楽</label>
                <select name="music" id="music">
                    <option></option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option>{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <div>
                <label for="home_economics">家庭科</label>
                <select name="home_economics" id="home_economics">
                    <option></option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option>{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <div>
                <label for="english">英語</label>
                <select name="english" id="english">
                    <option></option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option>{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <div>
                <label for="art">美術</label>
                <select name="art" id="art">
                    <option></option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option>{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <div>
                <label for="health_and_physical_education">保健体育</label>
                <select name="health_and_physical_education" id="health_and_physical_education">
                    <option></option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option>{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <input type="submit" name="create" value="登録" />
        </form>
        <div>
            <a href="/displayStudentDetail/{{ $student->id }}"><button type="button">戻る</button></a>
        </div>
    </div>
    @endif
</body>

</html>
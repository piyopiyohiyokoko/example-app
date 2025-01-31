<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>成績編集</title>
</head>

<body>
    <div>
        <h1>成績編集</h1>
    </div>

    {{-- フラッシュメッセージの表示 --}}
    @if (session('error'))
    <div>
        {{ session('error') }}
        <a href="/menu"><button type="button">メニュー画面へ戻る</button></a>
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
        <h4>【成績情報】</h4>
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
        <form action="/editSchoolGrade" method="post">
            @csrf
            <input type="hidden" name="student_id" id="student-id" value="{{ $student->id }}">
            <input type="hidden" name="id" id="school-grade-id" value="{{ $schoolGrade->id }}">
            <div>
                <label>学年: </label>
                <select name="grade" id="grade">
                    @for ($i = 1; $i <= 6; $i++)
                        <option value="{{ $i }}" {{ $i == $schoolGrade->grade ? 'selected' : '' }}>
                        {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label>学期: </label>
                <select name="term" id="term">
                    @for ($i = 1; $i <= 3; $i++)
                        <option value="{{ $i }}" {{ $i == $schoolGrade->term ? 'selected' : '' }}>
                        {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <p></p>
            <div>
                <label for="japanese">国語</label>
                <select name="japanese" id="japanese">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $i == $schoolGrade->japanese ? 'selected' : '' }}>
                        {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="math">数学</label>
                <select name="math" id="math">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $i == $schoolGrade->math ? 'selected' : '' }}>
                        {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="science">理科</label>
                <select name="science" id="science">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $i == $schoolGrade->science ? 'selected' : '' }}>
                        {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="social_studies">社会</label>
                <select name="social_studies" id="social_studies">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $i == $schoolGrade->social_studies ? 'selected' : '' }}>
                        {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="music">音楽</label>
                <select name="music" id="music">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $i == $schoolGrade->music ? 'selected' : '' }}>
                        {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="home_economics">家庭科</label>
                <select name="home_economics" id="home_economics">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $i == $schoolGrade->home_economics ? 'selected' : '' }}>
                        {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="english">英語</label>
                <select name="english" id="english">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $i == $schoolGrade->english ? 'selected' : '' }}>
                        {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="art">美術</label>
                <select name="art" id="art">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $i == $schoolGrade->art ? 'selected' : '' }}>
                        {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="health_and_physical_education">保健体育</label>
                <select name="health_and_physical_education" id="health_and_physical_education">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $i == $schoolGrade->health_and_physical_education ? 'selected' : '' }}>
                        {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <input type="submit" name="edit" value="更新" />
        </form>
        <div>
            <a href="/displayStudentDetail/{{ $student->id }}"><button type="button">戻る</button></a>
        </div>
    </div>
    @endif
</body>

</html>
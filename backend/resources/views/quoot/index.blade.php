<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quotter</title>
</head>
<body>
    <h1>Quotter</h1>
    @if (\Illuminate\Support\Facades\Auth::check())
        <button onClick="location.href='/quoot/create'">Quoot作成画面へ</button>
        <button onClick="location.href='/user/{{rawurlencode($userName)}}'">マイページへ</button>
    @else
        <button onClick="location.href='/login'">ログイン画面へ</button>
    @endif
    @foreach ($quoots as $quoot)
        <div style="border: 1px solid black; margin: 10px; padding: 10px;">
            <p>Quoot ID: {{$quoot->id}}</p>
            <p>内容: {{$quoot->content}}</p>
            <p>作成者: <a href="/user/{{$quoot->quser->user_name}}">{{$quoot->getDisplayName()}}</a></p>
            <p>作成日: {{$quoot->created_at}}</p>
            <!-- ログインユーザーIDの場合、修正・削除可能 -->
            @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::id() === $quoot->user_id)
                <button onClick="location.href='/quoot/update/{{$quoot->id}}?redirect=/quoot'">修正</button>
                <form method="POST" action="{{ route('quoot.delete', ['quootId' => $quoot->id, 'redirect' => '/quoot']) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
            @endif
        </div>
    @endforeach
</body>
</html>

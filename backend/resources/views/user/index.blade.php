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
    <h2>ユーザ {{$userName}} のページ</h2>
    <button onClick="location.href='/quoot'">Quoot一覧へ</button>
    <button onClick="location.href='/user/{{$userName}}/follows'">フォローリストへ</button>
    <button onClick="location.href='/user/{{$userName}}/followers'">フォロワーリストへ</button>
    @if (! $isMyPage)
        @if (! $hasFollowed)
            <form method="POST" action="/user/{{$userName}}/follow" style="display: inline;">
                @csrf
                <button type="submit">フォローする</button>
            </form>
        @else
            <form method="POST" action="/user/{{$userName}}/follow" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('本当に解除しますか？')">フォロー解除</button>
            </form>
        @endif
        <!-- チャットを開始する -->
        <form method="POST" action="/user/{{$userName}}/chat">
            @csrf
            <button type="submit">チャットを開始する</button>
        </form>
    @endif
    @foreach ($quoots as $quoot)
        <div style="border: 1px solid black; margin: 10px; padding: 10px;">
            <p>Quoot ID: {{$quoot->id}}</p>
            <p>内容: {{$quoot->content}}</p>
            <p>作成者: {{$quoot->getDisplayName()}}</p>
            <p>作成日: {{$quoot->created_at}}</p>
            <!-- ログインユーザーIDの場合、修正・削除可能 -->
            @if ($isMyPage)
                <button onClick="location.href='/quoot/update/{{$quoot->id}}?redirect=/user/{{rawurlencode($userName)}}'">修正</button>
                <form method="POST" action="{{ route('quoot.delete', ['quootId' => $quoot->id, 'redirect' => '/user/' . rawurlencode($userName)]) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
            @endif
        </div>
    @endforeach
</body>
</html>

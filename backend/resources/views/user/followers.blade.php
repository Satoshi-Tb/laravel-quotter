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
    <h2>ユーザ {{$userName}} のフォロワー</h2>
    <button onClick="location.href='/quoot'">Quoot一覧へ</button>
    <button onClick="location.href='/user/{{$userName}}'">ユーザページへ</button>
    @foreach ($followingUsers as $follower)
        <div style="border: 1px solid black; margin: 10px; padding: 10px;">
            <p> ユーザ名: <a href="/user/{{$follower->user_name}}">{{$follower->display_name}}</a></p>
        </div>
    @endforeach
</body>
</html>

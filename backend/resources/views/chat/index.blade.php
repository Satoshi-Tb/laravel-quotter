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
    <h2>{{$chatId}} 番の部屋</h2>
    <p>{{$users[0]}}と{{$users[1]}}のチャット部屋</p>
    <!-- メッセージ投稿 -->
    <form action="/chat/{{$chatId}}/messages" method="post">
        @csrf
        <textarea id="message-content" name="message" rows="4" cols="40" placeholder="メッセージを入力"></textarea><br>
        <input type="submit" value="送信">
        <input type="reset" value="クリア">
    </form>

    <h3>メッセージ一覧</h3>
    <!-- 時刻、メッセージ、投稿者を表示 -->
    <ul>
        @foreach($messages as $message)
            <li>
                [{{$message->created_at}}]
                {{$message->getDisplayName()}}:
                {{$message->content}}
            </li>
        @endforeach
</body>
</html>
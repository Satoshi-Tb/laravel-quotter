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
    <h1>Quotter更新画面</h1>
    <div>
        <p>更新フォーム</p>
        <form method="POST" action="/quoot/update/{{$quootId}}">
            @method('PUT')
            @csrf
            <input type="hidden" name="redirect" value="{{$redirectPath}}">
            <div>
                <label for="content">内容:</label><br>
                <textarea id="quoot-content" type="text" name="quoot" rows="4" cols="50" required>{{$content}}</textarea>
            </div>
            <div>
                <button type="submit">更新</button>
                <button type="reset">リセット</button>
                <button type="button" onClick="location.href='{{$redirectPath}}'">戻る</button>
            </div>
        </form>
    </div>
</body>
</html>

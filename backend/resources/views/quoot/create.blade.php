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
    <h1>Quotter作成画面</h1>
    <div>
        <p>投稿フォーム</p>
        <form method="POST" action="/quoot/create">
            @csrf
            <div>
                <label for="content">内容:</label><br>
                <textarea id="quoot-content" tyep="text" name="quoot" rows="4" cols="50" required></textarea>
            </div>
            <div>
                <button type="submit">投稿</button>
                <button type="reset">リセット</button>
            </div>
        </form>
    </div>
</body>
</html>
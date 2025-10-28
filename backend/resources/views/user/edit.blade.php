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
    <h2>ユーザ {{$displayName}} のページ</h2>
    <!-- 表示名、プロフィール編集画面 -->
    <form method="POST" action="{{ route('user.edit.put', ['userName' => $userName]) }}">
        @csrf
        @method('PUT')
        <label for="display-name">表示名:</label><br>
        <input type="text" id="display-name" name="display_name" value="{{$displayName}}" required><br>
        <label for="profile">プロフィール:</label><br>
        <textarea id="profile" name="profile" rows="4" cols="40">{{$profile}}</textarea><br>
        <input type="submit" value="更新">
        <input type="reset" value="リセット">
    </form>
</body>
</html>

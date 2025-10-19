# PHPStan 導入手順まとめ

本書は Laravel Quotter プロジェクトに PHPStan（Larastan）を導入し、静的解析を実行できるようにするまでの手順をまとめたものです。作業環境は `docker compose` で起動した PHP コンテナを前提としています。

## 1. コンテナに入る

```bash
docker compose exec php bash
cd /var/www/html
```

## 2. PHPStan と Larastan の追加

```bash
composer require --dev phpstan/phpstan larastan/larastan
```

## 3. 設定ファイルの配置

`phpstan.neon` が存在しない場合はプロジェクト直下に作成し、以下の内容を記述します。

```neon
includes:
    - vendor/nunomaduro/larastan/extension.neon

parameters:
    paths:
        - app
        - routes
    level: 5
    bootstrapFiles:
        - bootstrap/app.php
```

-   `paths` に静的解析対象が含まれるファイルのパスを指定してください。
-   `includes` のパスは実際のファイルインストールパスにあわせて調整してください。
-   既にファイルがある場合は、設定内容を適宜調整してください。

## 4. 解析の実行

```bash
./vendor/bin/phpstan analyse --memory-limit=1G
```

エラーが表示されなければ導入完了です。Notice などが報告された場合は指摘箇所を修正し、必要に応じて `level` を上げていきます。

# プロジェクトガイドライン

思考は英語で行い、最終的な出力は必ず日本語で提供してください。

## プロジェクト構成とモジュール配置

このモノレポは Laravel アプリケーションを収めた `backend/` と、将来のための空の `frontend/` に分かれています。`backend/` 内ではドメインロジックが `app/`、HTTP ルートが `routes/`、テンプレートと Alpine/Tailwind 資産が `resources/`、マイグレーションやシーダーを含むデータ関連ファイルが `database/` にあります。挙動テストは `tests/Feature`、集中的なユニット検証は `tests/Unit` に配置してください。ランタイム環境は `docker/`、補足資料は `docs/`、`compose.yml` や `vite.config.js`、`tailwind.config.js` などの設定はルート直下にまとまっています。

## ビルド・テスト・開発コマンド

日常開発では `backend/` ディレクトリで `composer run setup` を実行し、PHP/Node 依存解決、`.env` 生成、マイグレーション、Vite ビルドを一括で完了させます。開発サイクルは `composer run dev` が Laravel サーバー・キュー待受・ログストリーム・Vite を一度に立ち上げます。テストは `composer run test` または `php artisan test` で Pest スイートを起動し、静的資産の再ビルドは `npm run build` を使います。Docker を利用する場合はリポジトリ直下で `docker compose up --build` を実行してください。

## コーディングスタイルと命名

PSR-12 に従い 4 スペースインデントと PSR-4 名前空間（`App\` 以下）を維持します。コントローラやジョブ、フォームリクエストは `PostController` や `SendNotificationJob` のように StudlyCase で役割を示してください。Blade と Alpine の補助スクリプトは `resources/views` と `resources/js` に並べて配置します。PHP の整形は `./vendor/bin/pint`（設定は `pint.json`）で行い、`./vendor/bin/phpstan analyse`（`phpstan.neon`）で静的解析を通してからレビューに出します。Tailwind のユーティリティが増えたらコンポーネント化やレイアウト化で整理する方針です。

## テスト方針

ユーザーフローに沿った Pest の機能テストは `tests/Feature/PostQuotationsTest.php` のように対象機能名で作成し、サービス単位の小規模ロジックは `tests/Unit` に追加します。フィクスチャはファクトリで用意し、データベース変更はトランザクションで包みます。ローカルで SQLite を使う場合も、本番想定の MySQL/Postgres で再現できるか確認してください。全ての PR は `composer run test` をクリーンに通し、新しいエンドポイントやバグ修正には対応するテストを必ず添付します。

## コミットとプルリクエスト運用

履歴では `メッセージ表示機能実装` のような簡潔な主語＋動作のサマリが使われています。スコープが明確な場合は `feed: APIレスポンス調整` のように領域タグを付けるとレビュアーが把握しやすくなります。プルリクエストでは 1) 変更概要、2) 関連 issue や背景、3) マイグレーション／シーディング手順、4) UI 変化や API レスポンスのスクリーンショット・サンプルを含めてください。差分は関連変更に絞り、レビュー前にリベースし、破壊的変更は早期に共有します。

## 環境設定とシークレット管理

Docker を使わない場合は `backend/.env.example` を `backend/.env` にコピーし、DB 接続設定を更新したうえでスキーマ変更後に `php artisan migrate --force` を実行します。シークレットはコミットせず、`.env` のオーバーライドや無視対象の Docker 用 `.env` で管理してください。プレビュー環境を共有する前にはアプリキーや API トークン、Webhook シークレットを更新します。

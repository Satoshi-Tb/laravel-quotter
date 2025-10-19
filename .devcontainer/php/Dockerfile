FROM php:8.4

# composerベースイメージからバイナリをコピー(マルチステージビルド)
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

#ライブラリのインストール等
RUN apt-get update && \
    apt-get -y install --no-install-recommends git unzip curl ca-certificates gnupg libzip-dev libicu-dev libonig-dev procps && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-install intl pdo_mysql zip bcmath

# Xdebug for interactive debugging from VS Code devcontainer
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Provide Xdebug runtime configuration via bundled ini file
COPY .devcontainer/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Node.js (for Vite build tool, Tailwind, etc.)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get update && \
    apt-get install -y --no-install-recommends nodejs && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# グループ、ユーザー作成
RUN groupadd gphp && \
    useradd -m -d /home/php -g gphp -s /bin/bash php

# Composer用のキャッシュフォルダ作成
RUN mkdir -p /home/php/.composer/cache \                                                                          
    && chown -R php:gphp /home/php

#デフォルト命令を実行するユーザをrootからphpに変更
USER php

#作業ディレクトリを設定　
#ホストOSの/srcの中身をコピー&所有者設定
WORKDIR /var/www/html
COPY --chown=php:gphp ./backend /var/www/html/

# 初回起動時に各種物件のインストール必要
# composer install && npm install

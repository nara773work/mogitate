## アプリケーション名
mogitate-app

## 環境構築手順
1.Docker Desktopを起動させる

2.Laravelプロジェクトを作成する
//docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    -e COMPOSER_CACHE_DIR=/tmp/composer_cache \
    laravelsail/php82-composer:latest \
    composer create-project laravel/laravel:^10.0 mogitate-app

3.作成したフォルダに移動する
//cd mogitate

4.Laravel sailをインストールする
//docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    -e COMPOSER_CACHE_DIR=/tmp/composer_cache \
    laravelsail/php82-composer:latest \
    composer require laravel/sail --dev

5.設定ファイルをパブリッシュする(SQL指定)
//docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    -e COMPOSER_CACHE_DIR=/tmp/composer_cache \
    laravelsail/php82-composer:latest \
    php artisan sail:install --with=mysql

※M1/M2/M3 Mac（Apple Silicon）をお使いの方

Apple Silicon搭載のMacでは`sail up -d`実行時に以下のエラーが発生することがある

```
no matching manifest for linux/arm64/v8
```

解決方法： `compose.yaml`を開き、mysqlサービスに`platform: 'linux/amd64'`を追加する
mysql:
    image: 'mysql/mysql-server:8.0'
    platform: 'linux/amd64'  # ← この行を追加
    ports:

6..env ファイルを開き、データベース接続情報が以下と一致していることを確認する
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password

7.compose.yaml に以下の内容を追加する

    phpmyadmin:
        image: 'phpmyadmin:latest'
        ports:
            - '${FORWARD_PHPMYADMIN_PORT:-8080}:80'
        environment:
            PMA_HOST: mysql
            PMA_USER: '${DB_USERNAME}'
            PMA_PASSWORD: '${DB_PASSWORD}'
        networks:
            - sail
        depends_on:
            - mysql

8.sailをバックグラウンドで起動する
// ./vendor/bin/sail up -d

9.エイリアスを設定する
//echo "alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'" >> ~/.zshrc

10.ターミナルを再起動する
//exec $SHELL

11.アプリケーションキーを設定する
//sail artisan key:generate

12.初期データを投入する
//sail artisan migrate --seed
既存のデータをリセットする場合は以下のコマンドを実行する
//sail artisan migrate:fresh --seed

## 使用技術
OS:Windows11
PHP:8.2
DB:MySQL8.0
Webサーバ:Nginx
開発ツール:Docker,Laravel Sail,phpMyAdmin

## ER図
![ER図](/ER.drawio.png)

## URL
http://localhost/

## 作成者
奈良 那々美
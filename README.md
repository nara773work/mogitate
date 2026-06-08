## アプリケーション名
mogitate

## 環境構築手順
1. .envを作成し、中身を以下のように書き換える
//cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password

2.Dockerをビルドする
//docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd):/var/www/html" \
  -w /var/www/html \
  -e COMPOSER_CACHE_DIR=/tmp/composer_cache \
  laravelsail/php82-composer:latest \
  composer install

3.sailをバックグラウンドで起動する
// ./vendor/bin/sail up -d

4.エイリアスを設定する
//echo "alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'" >> ~/.zshrc

5.ターミナルを再起動する
//exec $SHELL

6.アプリケーションキーを設定する
//sail artisan key:generate

7.初期データを投入する
//sail artisan migrate:fresh --seed

8.シンボリックリンクを作成する
//sail artisan storage:link

## 使用技術
OS:Windows11
PHP:8.2
DB:MySQL8.0
Webサーバ:Nginx
開発ツール:Docker,Laravel Sail,phpMyAdmin

## ER図
![ER図](/ER.drawio.png)

## URL
一覧画面
http://localhost/products

詳細画面
http://localhost/products/detail/{productId}



## 作成者
奈良 那々美
## アプリケーション名
mogitate-app

## 環境構築手順
1.Docker Desktopを起動させる

2.gitURLをクローンする
//git clone ＜リポジトリURL＞

3.ディレクトリに移動する
//cd mogitate-app

4.sailをバックグラウンドで起動する
// ./vendor/bin/sail up -d

5.エイリアスを設定する
//echo "alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'" >> ~/.zshrc

6.ターミナルを再起動する
//exec $SHELL

7.アプリケーションキーを設定する
//sail artisan key:generate

8.初期データを投入する
//sail artisan migrate --seed
既存のデータをリセットする場合は以下のコマンドを実行する
//sail artisan migrate:fresh --seed

9.シンボリックリンクを作成する
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
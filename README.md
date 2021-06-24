## 前提  
・dockerコマンド及びdocker-composeコマンドが実行可能であること。  
・当該リポジトリをcloneしていること。  
<br>

---  
<br>

## 手順  
1. （初回のみ）下記コマンドを実行する。  
`$ docker-compose up -d --build`  
<br>

    ※ 2回目以降は立ち上げ時に下記コマンドを実行する。  
`$ docker-compose up -d`  
<br>

2. appコンテナに入る。  
`$ docker-compose exec app bash`  
<br>

3. 必要なライブラリをインストールする。  
`# composer install`  
`# npm install`  
<br>

4. マイグレーションファイルを実行する。  
`# php artisan migrate`  
<br>

5. jsとcssをビルドする。  
`# npm run dev`  
<br>

6. [トップページ](http://localhost:8080/)に遷移して確認。  
<br>

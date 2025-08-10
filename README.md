お問い合わせフォーム

## 環境構築
**Dockerビルド**
1. `git clone https://github.com/otaketaro/coachtech-exam.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`

**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを コピーして「.env」を作成
    cp .env.example .env

4. .envファイル内のDB設定を下記のように変更
``` text
DB_HOST=mysql
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
``` bash
php artisan key:generate
```

6. マイグレーションの実行
``` bash
php artisan migrate
```

7. シーディングの実行
``` bash
php artisan db:seed
```

## 使用技術
1. Laravel Framework 8.83.8
2. PHP 8.1.33
3. MySQL 8.0.26
4. Docker 28.0.1


## ER図
┌─────────────┐           ┌─────────────┐
│  categories │◄──────────│   contacts  │
│─────────────│           │─────────────│
│ id (PK)     │           │ id (PK)     │
│ content     │           │ category_id │
│ created_at  │           │ first_name  │
│ updated_at  │           │ last_name   │
└─────────────┘           │ gender      │
                          │ email       │
                          │ tel         │
                          │ address     │
                          │ building    │
                          │ detail      │
                          │ created_at  │
                          │ updated_at  │
                          └─────────────┘

┌──────────┐
│  users   │
│──────────│
│ id (PK)  │
│ name     │
│ email    │
│ password │
│ created_at│
│ updated_at│
└──────────┘



## URL
- 開発環境：http://xxxxxx
- phpMyAdmin:：http://xxxxxx
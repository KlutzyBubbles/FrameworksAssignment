<h1 align="center">Frameworks Assignment</h1>

<p align="center">
<a href="https://packagist.org/packages/klutzybubbles/laravel-skeleton"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/klutzybubbles/laravel-skeleton"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About

This is my frameworks assignment, a few commands will need to be run before the program will work. Please note these commands will need to be executed in this order.

```bash
composer install
```

```bash
npm install
```


You will need to create a ``` .env``` file before running the commands below, here is my local ```.env``` template

```text
APP_NAME=Assignment
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=assignment
DB_USERNAME=root
DB_PASSWORD=root

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

```

```bash
php artisan key:generate
```

```bash
php artisan migrate:refresh
```

```bash
php artisan db:seed
```


Sometimes the css and js files either havent been pushed or i havent updated them, just use the command below to refresh them

```bash
npm run dev
```

After all of the commands have been run the program will be setup with 50 of each supported Model along with 1 admin staff acount

Username: ```LTzilantonis@gmail.com```

password: ```secret```


<br>
Currently i am running v5.7 but plan to downgrade to the stable v5.6


## Laravel Repo

https://github.com/laravel/laravel
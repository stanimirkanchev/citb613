<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Prerequisites

- MySQL v8.0.0 or later
- PHP v8.2.0 or later
- Composer v2.5.5 or later
- Npm v9.3.0 or later
- Node v18.14.0 or later

## How to install
 1. Git clone the project in a directory by choice.
 1. Copy the .env.example file and rename it to .env for example running the `cp .env.example .env` command.
    1. Enter your Database information there.
    2. Make sure you have the databse already created in your MySQL server with the same name.
 1. Now you can run `composer install` and `npm i` or `npm ci`
 1. Once composer and npm are installed you can migrate and seed the database using this command: `php artisan migrate:fresh --seed`
 1. Now run `npm run build` to build the assets
 1. And finally you can run `php artisan serve` to access the site on `127.0.0.1:8000`
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Prerequisites
The project is using Laravel v10.0 and all dependecies and docs can be found here: [Laravel Official Docs](https://laravel.com/docs/10.x).

The dependencies you will need to run laravel v10.x are:
- MySQL ^8.0
- PHP ^8.1
- Composer ^2.5.0
- Npm ^9.3.0
- Node ^18.13.0

## How to install
 1. Git clone the project in a directory by choice.
 1. Copy the .env.example file and rename it to .env for example running the `cp .env.example .env` command.
    1. Enter your Database information there.
    2. Make sure you have the databse already created in your MySQL server with the same name.
 1. Now you can run `composer install` and `npm i` or `npm ci`
 1. Once composer and npm are installed you can migrate and seed the database using this command: `php artisan migrate:fresh --seed`
 1. Now run `npm run build` to build the assets
 1. And finally you can run `php artisan serve` to access the site on `127.0.0.1:8000`

# The seeders will create 2 users
email: `user@abv.bg`, password: `123456`

and 

email: `admin@abv.bg`, password: `123456`

You can create a reservation as a guest in this case the form data will be used to create an account for you and if you have configured mailhog or any other email capture tool it will send you the password by email.

Admin users doesn't have any special rights in the interface because I was running out of time to do a full interface for adding rooms or editting reservations..
# Steps to create app

## Clone repo

## Create Lavarel

mkdir src
composer create-project laravel/laravel src

delete src/README.md
move rest to root
delete src folder

> someone knowing better way how to do it?

## Setup database

create file database/database.sqlite (can be empty) change in file .env value for DB_CONNECTION to be sqlite and comment other lines below.

Run `php artisan migrate`

## Adding Breeze to handle user infrastructure

composer require laravel/breeze --dev
php artisan breeze:install blade
php artisan migrate
npm install



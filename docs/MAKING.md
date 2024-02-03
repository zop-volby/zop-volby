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

Uncomment memory database usage in phpunit.xml, otherwise tests will delete your db.

## Starting app

Create cmd file (or bash if you like it)

```
start php artisan serve
start npm run dev
start http://localhost:8000
```

## Adding social logins

composer require laravel/socialite

Follow https://support.google.com/cloud/answer/6158849?hl=en to get client ID for Google 

Add Google to config/services.php

## Starting deployment file

Copied from another repo
It requires changes in composer.json: https://github.com/zop-volby/zop-volby/commit/47bc3ba5ca394b1632dfd13b0a7934bccc48ef7b
File .env has to get database connection

Also let's remove Tailwind and bring Bootstrap in instead

## Adding new entity

First controller

php artisan make:controller NomineeController --resource

Then model

php artisan make:model Nominee -m

Then fill in generated migration
and add the same properties to model
and then run migration

php artisan migrate

Then add routes to web.php

Route::resource('nominees', NomineeController::class)->middleware('auth');

Then add link to navigation

<x-nav-link :href="route('nominees.index')" :active="request()->routeIs('nominees.index')">
    {{ __('Kandidáti') }}
</x-nav-link>

Then start filling the controller. 
One method, one view.
Index, Create, Edit.

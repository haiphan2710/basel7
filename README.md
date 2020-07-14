<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

# BaseL7
Base on Laravel 7

- We build classes for making easy coding with laravel 7

- Reference:
  + Generate uuid       => goldspecdigital/laravel-eloquent-uuid
  + Roles & Permissions => santigarcor/laratrust
  + Enum                => bensampo/laravel-enum

# Usage Package

## Download from composer

- Run command: `composer require haiphan2710/basel7`

## Install BaseL7

- Add `BaseL7ServiceProvider` to `providers` in `config/app` file
- For installing BaseL7: `php artisan basel7:install`
- Go `providers` in `config/auth` file, update `model.users` to `App\Models\User::class`
- Extends `HaiPhan\BaseL7\Http\Controllers\Controller` to your `Controller`
- Optionals:
  + For making dummy User, we need to run `php artisan basel7:seed`

## Basic

- We work models on folder `Models`

## Setups:

- For the setup authentication: `php artisan basel7:setup --auth`
  + This command creates an `AuthController` in your `Controllers` folder
  + For usage, make route and call to functions in this controller 

- For the setup CRUD User: `php artisan basel7:setup --user`
  + Creates an `UserController` in your `Controllers` folder
  + Classes `UserFilter` and `CreateUserRequest` in `UserController` are examples, you can replace other classes
  + For usage, make route and call to functions in this controller

## Create a model

- Commands:
  - Auth: `php artisan basel7:model Models/{ModelName} --auth`
  - Model: `php artisan basel7:model Models/{ModelName}`
  - Pivot: `php artisan basel7:model Models/{ModelName} --pivot`

## Filter

- Steps for using:
  - Class need to extends "HaiPhan\BaseL7\Filters\BaseFilter"
  - Create functions in class for the query params with value
    - Ex: `public function nickname($nickname)` => Search nickname (with: value = $nickname)

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

- For installing BaseL7, run command: php artisan basel7:install

## Authentication

- For using authentication, User model need to extend class "HaiPhan\BaseL7\Models\Authentication"

## Create a model

- Commands:
  + Model: php artisan basel7:model ModelName
  + Pivot: php artisan basel7:model Models/{ModelName} --pivot

## Filter

- Steps for using:
    + Class need to extends "HaiPhan\BaseL7\Filters\BaseFilter"
    + Create functions in class for the query params with value.
        Example: `public function nickname($nickname)` => Search nickname (with: value = $nickname)

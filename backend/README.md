<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# SAIL commands

## To start Docker containers

sail up -d

## To stop Docker containers

sail stop

## Running Artisan commands within Laravel Sail...

sail artisan ...whatever e.g: queue:work

## Executing php or composer

sail php --version

sail php script.php

sail composer require laravel/sanctum

## Running Tests

sail test

sail test --group orders

## Container CLI

sail shell

sail root-shell

## Installing Composer Dependencies for Existing Applications

If you are developing an application with a team, you may not be the one that initially creates the Laravel application. Therefore, none of the application's Composer dependencies, including Sail, will be installed after you clone the application's repository to your local computer.

You may install the application's dependencies by navigating to the application's directory and executing the following command. This command uses a small Docker container containing PHP and Composer to install the application's dependencies:

docker run --rm \
 -u "$(id -u):$(id -g)" \
 -v "$(pwd):/var/www/html" \
 -w /var/www/html \
 laravelsail/php83-composer:latest \
 composer install --ignore-platform-reqs

When using the laravelsail/phpXX-composer image, you should use the same version of PHP that you plan to use for your application (80, 81, 82, or 83).

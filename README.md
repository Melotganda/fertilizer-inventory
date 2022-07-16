
# Fertilizer Inventory

This is just a simple laravel application that uses lucid architecture. It is easy to use to find out how many more stocks are available in the inventory and how much is the total quantity you are asking for.




## Prerequisites

This project was created in Windows and runs in Laravel 9 and PHP (>= 8.0.0), this project has a few system requirements:
- installed docker
- composer
- WSL2 for windows

This project uses Laravel Sail for docker. 

NOTE: Docker should be running in background
## Environment Variables

To run this project, you will need to add the following environment variables to your .env.template file

```bash
DB_DATABASE=<your_database_name>
```


## Installation

After cloning, `cd` to project directory and run these commands:

```bash
cp .env.template .env

composer install

bash ./vendor/laravel/sail/bin/sail up
```

Enter the docker container and run these commands

```bash
php artisan key:generate

composer install

npm install

```

Then, run the following for database setup:
```bash
php artisan migrate

php artisan db:seed
```

Once you have started the docker container, your application will be accessible in your web browser at http://localhost



## Run Locally

Prerequisites to run this on local:
- PHP (>= 8.0.0)
- Composer (2.1.5)
- MySql Database

After cloning, `cd` to project directory and run these commands:

Go to the project directory

```bash
    cd my-project

    cp .env.template .env
```

Install dependencies

```bash
    php artisan key:generate

    composer install

    npm install
```

For the database

```bash
    php artisan migrate

    php artisan db:seed
```

Start the server

```bash
    php artisan serve
```
Once you have started the Artisan development server, your application will be accessible in your web browser at http://localhost:8000.


## # Directory Structure
Since the project uses lucid architecture, here's the directory structure:
```bash
├── app
│   ├── Console
│   │   ├── Kernel.php
│   ├── Data
│   │   ├── Models (contains all models in application)
│   ├── Domains
│   ├── Features
│   ├── Http
│   │   ├── Controllers (contains all controllers in application)
│   │   ├── Middleware
│   │   ├── Requests
│   └── partials/template
├── bootstrap
├── config
├── database (contains all database migrations, factory and seeders)
├── lang
├── node_modules
├── public
├── resources (contains views from blade)
├── routes (contains all routes)
├── storage
├── tests (contains all tests)
├── vendor
├── .env
├── composer.json
├── package.json
├── README.md
└── .gitignore
└── others...
```
## Running Tests

To run tests, run the following command inside the docker container

```bash
  php artisan test
```


## Authors

- [@melotpogi](https://github.com/Melotganda)


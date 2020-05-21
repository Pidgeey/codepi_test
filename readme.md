# Codepi - Test
This application use:
```
Laravel 6
VueJs 2
Bootstrap
```
## Deploy
Install composer dependencies
```
composer install
```

##Init environment

This application use MySQL. You have to create a database before initialize the application

Create a .env file in root application and copy .env.exemple content. Then set theses fields
```
DB_DATABASE={your database}
DB_USERNAME={your username}
DB_PASSWORD={your password}

Take care about your DB_PORT
```

Create an application key
```
php artisan key:generate
```

Initialize database with migrations
```
php artisan migrate
```

### Start application
Now, you can start the php server with `public/` folder for root
```
php -S localhost:8000 -t public/
```


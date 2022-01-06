# Laravel vuejs 3 api composition

Create a simple Customers Crud with Vuejs 3 and Laravel 8.

## Technologies & versions

- Laravel 8.68.1
- Vue 3.2.20, vue-router 4.0.12, axios and others
- Tailwind 2.0.2

## Knowledges and skills

- Api with laravel (Ressources, Validation Request, Test and more..)
- Auth with Laravel Breeze
- Vue (Routing, Services, Forms and more..)

## Add this vhost
```
<VirtualHost *:80> 
    DocumentRoot "YOUR_WEB_ROOT_SERVER/www/laravel-vuejs-3-api-composition/public/"
    ServerName laravel-vuejs-3-api-composition.test
    ServerAlias *.laravel-vuejs-3-api-composition.test
    <Directory "YOUR_WEB_ROOT_SERVER/www/laravel-vuejs-3-api-composition/public/">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## Install
```
- Clone project 
- Make: composer install
- Create a database named laravel8-vue3
- Make: php artisan migrate
- Make: php artisan migrate --seed
- Make: npm install
- Make: npm run build
- Go to project localhost url ex: http://laravel-vuejs-3-api-composition.test 
```

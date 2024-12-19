<<<<<<< HEAD
# todolist
=======

1. You need Composer and Node JS
2. After you clone this repository, open terminal, go to /backend then run composer install and npm install.
3. Then run on terminal: cp .env.example .env
4. Configure the database setup on .env
    example:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=database_name
    DB_USERNAME=root
    DB_PASSWORD=
   Don't forget to create your database
6. Then run: php artisan key:generate
7. Run: php artisan migrate
8. Next run: npm run dev
9. Run: php artisan serve
10. By default, this will make the application available at http://127.0.0.1:8000.



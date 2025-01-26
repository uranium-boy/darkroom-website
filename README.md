# Darkroom Rental Website

This is a website for renting film photography darkrooms, created as a university project for web application programming classes.

## Author
Maciej Janczara

## Functionalities
- **Guest access**: view reservation schedules for each darkroom without logging in
- **User authorization**: login and registration functionality
- **Calendar view**: interactive calendar that displays reserved slots for each darkroom and allows logged-in users to create new reservations
- **Reservations**: logged-in users can create and delete their reservations
- **Admin panel**: admins can manage users and darkrooms (create, modify, delete) via specialized admin panels

## Used Technologies
- Backend: Laravel
- Database: SQLite (using Eloquent ORM)
- Reservation schedule logic: FullCalendar plugin
- Frontend: Laravel Breeze starter kit, Blade templates, TailwindCSS

## Dependencies
- PHP 8.3.15
- Laravel Framework 11.36.1
- sqlite 3.48.0
- npm 11.0.0
- node v23.4.0

The project has not been tested with other versions of the above dependencies, compatibility cannot be guaranteed.

## How to run this project
In the project directory run the following commands:
1. `composer install`
    installs PHP dependencies from `composer.json` file
2. `npm install`
    installs JS dependencies from `package.json` file
3. `npm run build`
    builds frontend assets
4. `cp .env.example .env`
    copy the envinronment configuration file
5. `php artisan key:generate`
    generates a new application key for encryption
6. `sqlite3 database/database.sqlite < database_dump.sql`
    imports database (`php artisan migrate` can be used to create a new, empty database)
7. `php artisan serve`
    starts PHP server

The website should then be available at the defualt address `localhost:8000`

In case of errors related to the database, please make sure that the `pdo_sqlite` extension is installed and enabled
(this can be checked by running `php -m`)

## Test accounts
- **Admin**
    - Email: `admin@admin.com`
    - Password: `adminadmin`
- **Regular User**
    - Email: `user@user.com`
    - Password: `useruser`
- **Another User**
    - Email: `another@another.com`
    - Password: `anotheranother`



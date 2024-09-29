<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>
<!-- 
# Repositori for Laravel Apps

Repository for Laravel Apps, writen in PHP with Framework Laravel Version `8.x`.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe devaelopment must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Database Migration

Migrations are like version control for your database, allowing your team to define and share the application's database schema definition. If you have ever had to tell a teammate to manually add a column to their local database schema after pulling in your changes from source control, you've faced the problem that database migrations solve.

The Laravel `Schema` `facade` provides database agnostic support for creating and manipulating tables across all of Laravel's supported database systems. Typically, migrations will use this facade to create and modify database tables and columns.

If you need to alter the database on your development:

1. Create migration file: `php artisan make:migration {description}`.
   1. Example : `php artisan make:migration create_flights_table`
   2. Write your up and down queries in the generated files accordingly.
   3. See migration file samples in `app/database/migrations`.
2. To verify your migration queries:
   1. Execute `php artisan migrate` and verify the result in the database.
   2. This will also update the row in _migration table_ (table name is in .env).
   3. Do not forget to drop your changes to go back to previous database state: `php artisan migrate:rollback`

Reference: laravel-migrate: https://laravel.com/docs/8.x/migrations

## How to run locally

This repo requires PHP >= 7.3.

### Step To Run

1. Clone this repository to your local run `git clone http://10.100.111.95/KalKausar/laravel-apps.git {project-name}`
   - Example : `git clone http://10.100.111.95/KalKausar/laravel-apps.git rm-tools`
2. Change remote url git : `git remote set-url origin {url_destination_git}`
   - Example : `git remote set-url origin https://github.com/USERNAME/REPOSITORY.git`
3. Edit your own config in `/.env`.
4. Run `php artisan migrate`.
5. Run `php artisan serve`.
6. If you don't run the command `php artisan serve` anywhere, you can access `127.0.0.1:8000` to see application.
   - Login with:
   - `username`: `80690222`
   - `password`: `P@ssword321`

### Step To Push Gitlab

If you haven't written or changed anything from the last pull

1. Run `git pull`

If you have written or changed anything from the last pull

1. Run `git add .`
2. Run `git commit -m {description}`
   - Example `git commit -m "push fitur download"`
3. Run `git pull`
4. If there is a conflict in git
   1. Resolve conflict
   2. Run `git add .`
   3. Run `git commit -m {description}`
5. Run `git push -u origin {branch}`
   - Example `git push -u origin master` -->

## Requirements

* PHP version >7.1.0
* A MySQL or PgSQL Server
* Apache/Nginx/Whatever you're plugging into PHP-FPM; I couldn't care less

## Quick-Start

1. Copy the `.env.example` file to `.env` and fill out the respective DB variables
2. `$ php artisan key:generate`
3. `$ php artisan migrate`
4. `$ php artisan db:seed`
5. `$ php artisan serve`

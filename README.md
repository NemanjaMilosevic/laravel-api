Opinodo Laravel API
===================================
This sample demonstrates Laravel RESTful API.
Demonstration of REST Api functions with creating functional test that use the REST Layer directly.


Documentation
------------
Please consult doc/spec.pdf for api specification.


Features
--------------

- User roles (producer, customer)
- Article CRUD
- Token api auth system
- Article grading system
- Article extension
- Unit tests
- Expired ads deletion (Cron/Laravel Scheduler)

Planned features
--------------

- Full OAuth2 support
- Ad view counter




## Testing

Note: Current set up uses PHPUnit tests and in-memory SQLite database for performant runs.

When running the API revert to permanent database and adjust database settings accordingly.

## Running the API

Add the following Cron entry to your server, to start a scheduler
`crontab -e`

`* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1`

It's very simple to get the API up and running.

First, create the database (and database
user if necessary) and add them to the `.env` file.

```
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_password
```

Then install, migrate, seed, all that jazz:

1. `composer install`
2. `php artisan migrate`
3. `php artisan db:seed`
4. `php artisan serve`

The API will be running on `localhost:8000`.





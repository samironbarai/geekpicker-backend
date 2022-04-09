## Geekpicker wallet laravel backend
  
### Installation
1. Clone this repo
```
git clone https://github.com/samironbarai/geekpicker-backend.git
```

2. Install composer packages
```
$ cd geekpicker-backend
$ composer install
```

3. Create and setup .env file
```
$ copy .env.example .env
$ php artisan key:generate
put database credentials in .env file
```

4. Change queue connection to database in .env file
```
QUEUE_CONNECTION=database
```

5. Put currency conversion api key in .env file
```
FIXER_ACCESS_KEY=YOUR_FIXER_ACCESS_KEY
```

6. Put sanctum key in .env file
```
SANCTUM_KEY=RANDOM_STRING
```

7. Put mailtrap credential
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
```

8. Migrate and insert records
```
$ php artisan migrate
$ php artisan db:seed
```

9. Run the server
```
$ php artisan serve
```

10. Run queue work
```
$ php artisan queue:work
```

To test API, use react js frontend application
https://github.com/samironbarai/geekpicker-frontend

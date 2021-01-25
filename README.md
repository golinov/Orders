Install project:
    - set settings for mailer;
    - php artisan migrate:fresh --seed;
    - php artisan queue:work.
Tests:
    - vendor/bin/phpunit;
Configs:
    - config/blocklist.php - list of countries which need to blocked;
    - config/mail.php, 'to' - email for send order details.

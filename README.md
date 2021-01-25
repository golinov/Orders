Install project:<br>
    <p>- set settings for mailer;</p>
    - php artisan migrate:fresh --seed;
    <p>- php artisan queue:work.</p>
Tests:<br>
    - vendor/bin/phpunit;<br>
Configs:<br>
    - config/blocklist.php - list of countries which need to blocked;<br>
    - config/mail.php, 'to' - email for send order details.<br>

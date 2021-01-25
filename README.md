Install project:
    <p>- set settings for mailer;</p>
    <p>- php artisan migrate:fresh --seed;</p>
    <p>- php artisan queue:work.</p>
Tests:<br>
    <p>- vendor/bin/phpunit;</p>
Configs:
    <p>- config/blocklist.php - list of countries which need to blocked;</p>
    <p>- config/mail.php, 'to' - email for send order details.</p>

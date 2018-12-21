##Simple PHP project following DDD structure  
# installation
Create your own server you can use apache xampp and create virtual host 


>composer install

For install database schema 
>./vendor/bin/doctrine-migrations migrations:migrate latest

For run unit testing
>composer test 

##For authentication method 
send  in requests header key Authorization with value  "your_secure_token"
You can check post man
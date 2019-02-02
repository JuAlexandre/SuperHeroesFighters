# super-heroes-fighters

## Instructions

Create a super heroes game in turns for the first WCS Hackathon.
The project will use the provided MVC model.

## Installation

Clone the repository and move in :
```
$ git clone https://github.com/JuAlexandre/super-heroes-fighters.git
$ cd super-heroes-fighters
```

Install dependencies :
```
composer install
```

Create `app/db.php` from `app/db.php.dist` file and add your DB parameters.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PWD', 'your_db_password');
```

Run a server on `index.php` with :
```
php -S localhost:8000 -t public
```

## Authors

* [Julia LIMOUSIN](https://github.com/1A2Z3E4R)
* [Louise ROY](https://github.com/Louisejesuis)
* [Emilie BERGER](https://github.com/EmilieBRG)
* [Jérôme LEGRAND](https://github.com/jeromelegrand)
* [Julien ALEXANDRE](https://github.com/jualexandre)

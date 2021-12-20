# A3-Symfony work

[![forthebadge](https://forthebadge.com/images/badges/winter-is-coming.svg)](http://forthebadge.com)  [![forthebadge](https://forthebadge.com/images/badges/powered-by-coffee.svg)](http://forthebadge.com)

This work was done as part of the Symfony course and refers to a back-office for superheroes.

## To begin with

### Pre-requisites

- PHP 7.4 or 8.0
- nginx/apache
- mysql
- Composer 2
- Symfony 5.4
- Symfony CLI (optional)

### Installation

Execute this in `laragon/www` :
```
git clone git@github.com:Pouniflu/A3-Symfony.git
```

Go to `laragon/www/A3-Symfony.git` and execute :
```
composer install
```

_If you don't have CLI Symfony, execute_
```
composer require webserverbundle ^4.4 --dev
```

## Launch

Create a file named `.env` by copy and paste `.env.sample`.
Don't forget to change this file with your ID and password.

Then, create your database and do the migrations:
```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

Now, you can launch the server
```
symfony server:start
or
php bin/console server:run
```

## Made with

* [Symfony](https://symfony.com) - Framework PHP
* [PHPStorm](https://www.jetbrains.com/fr-fr/phpstorm/) - Text editor
* [TablePlus](https://tableplus.com) - GUI tool for relational databases

## Author
**Claire Brisbart** _alias_ [@Pounfilu](https://github.com/Pouniflu), third year student in web development at [IIM Digital School](https://www.iim.fr).

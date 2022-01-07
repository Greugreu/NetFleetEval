# NetFleet

> Evaluation Symfony

## Technical Requirements
In order to be able to run the application on your workstation, you must install the following dependencies:
* Symfony 
* PHP 8.1 or higher
* Composer
* Postgresql

### Installation
#### Symfony
1. [Downdload](https://symfony.com/download)


#### Composer
1. [Downdload](https://getcomposer.org/)


## Execution

1. Ouvrir un terminal à la racine du projet
2. Check les requirements `$ symfony check:requirements`
3. `$ composer install`
4. Le env est configuré pour postgres avec un utilisateur nommé netfleet avec droits de création de DB.
5. `$ php bin/console doctrine:database:create`
6. `$ php bin/console doctrine:migrations:migrate`
7. Run server `$ php bin/console server:start`
8. Open a browser at [http://localhost:8000](http://localhost:8000)


Pour plus de détails sur le fonctionnement de Symfony [Synfony Docs](https://symfony.com/doc/4.4//index.html).

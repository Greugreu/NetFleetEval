# NetFleet

> Evaluation Symfony

## Requis Techniques
Pour faire tourner le projet:
* Symfony 
* PHP 8.1 ou plus
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
5. Créer la DB `$ php bin/console doctrine:database:create`
6. Appliquer la migration `$ php bin/console doctrine:migrations:migrate`
7. Charger les fixtures `$ php bin/console d:f:l`
8. Lancer le serveur `$ php bin/console server:start`
9. Ouvrir le navigateur à [http://localhost:8000](http://localhost:8000)


Pour plus de détails sur le fonctionnement de Symfony [Synfony Docs](https://symfony.com/doc/4.4//index.html).

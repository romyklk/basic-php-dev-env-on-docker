# Environement de développement PHP 8.2 basé sur DOCKER

Dans ce projet vous trouverez un environement de développement PHP 8.2 basé sur Docker. Il est composé d'un container PHP 8.2 et Apache 2.4, d'un container MySQL 8.0 et d'un container phpMyAdmin.

Il y a 2 branches :
- `main` : Sans variables d'environement
- `with-env` : Avec variables d'environement

En fonction de vos besoins vous pouvez choisir la branche qui vous convient.


## Prérequis

- Docker Desktop (Windows ou Mac) ou Docker Engine (Linux)
- Docker Compose

Cet environement de développement est composé de 3 containers :
1. PHP 8.2 et Apache 2.4
2. MySQL 8.0
3. phpMyAdmin


## Installation partie 1 : Sans variables d'environement

Téléccharger le projet ou copier le contenu des fichiers `Dockerfile` et `docker-compose.yml` dans votre projet. 

`Pour lancez les containers`, ouvrez un terminal à la racine du projet et tapez la commande suivante :

    docker-compose up -d

`Pour arrêtez les containers`, ouvrez un terminal à la racine du projet et tapez la commande suivante :
    
        docker-compose down

`Pour nettoyer les ressources docker`, ouvrez un terminal à la racine du projet et tapez la commande suivante :
    
        docker system prune -a

Elle permet de nettoyer les ressources Docker inutilisées sur votre système, y compris les images, les conteneurs, les volumes non utilisés et les réseaux non utilisés.


`Pour entrer dans un container`, ouvrez un terminal à la racine du projet et tapez la commande suivante :

    docker exec -it <nom du container> /bin/bash

`Pour voir les logs d'un container`, ouvrez un terminal à la racine du projet et tapez la commande suivante :

    docker logs <nom du container>

`Pour obtenir l'adresse IP d'un container`, ouvrez un terminal à la racine du projet et tapez la commande suivante :

    docker inspect database | grep IPAddress








### Dockerfile

Dans le `Dockerfile` à la ligne 25 qui contient `COPY ./ /var/www/html/` vous pouvez remplacer le `./` par le chemin vers votre projet.

Vous pouvez également modifier la version de PHP à la ligne 1 qui contient `FROM php:8.2-apache`. Ou encore ajouter des extensions PHP à la ligne 3 qui contient `RUN docker-php-ext-install pdo pdo_mysql`.

Aussi vous avez la possiblitée de choisir les éléments que vous souhaiter utiliser en commentant les concernés.

### docker-compose.yml

Vous pouvez changer le nom du container, le port d'écoute, le nom de la base de données, le mot de passe de la base de données, le nom d'utilisateur de la base de données et le mot de passe de phpMyAdmin.

Dans la partie volumes vous pouvez modifier le chemin vers votre projet.`/Applications/MAMP/htdocs/LEARNING/Docker/php-env` par exemple. N'oubliez pas de modifier le chemin dans la partie file sharing de Docker Desktop.


## Installation partie 2 : Avec variables d'environement

Pour la partie mysql, vous avez la possibilité d'utiliser des variable provenant d'un fichier `.env` en utilisant `${}`. Par exemple `${MYSQL_DATABASE}`.Pour cela il faut créer un fichier `.env` à la racine du projet et y ajouter les variables souhaitées. 

            DB_CONNECTION=mysql
            DB_HOST=db
            DB_PORT=3306
            DB_DATABASE=portfolio
            DB_USERNAME=myacces
            DB_PASSWORD=mysecret


Pour les variables d'environement, j'utilise la bibliothèque `vlucas/phpdotenv` qui permet de charger les variables d'un fichier `.env` dans `$_ENV` et `$_SERVER`. 


Pour télécharger la bibliothèque `vlucas/phpdotenv` ouvrez un terminal à la racine du projet et tapez la commande suivante :

    composer require vlucas/phpdotenv




Pour que cela marche  il faut ajouter les lignes suivantes dans le fichier `index.php` qui est le fichier dans lequel je fais la connexion à la base de données.Vous pouvez le modifier en fonction de vos besoins.

    require __DIR__ . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();



### Info 

N'oubliez pas de vous assurer que votre fichier .env ne soit pas inclus dans votre gestionnaire de contrôle de version (par exemple, gitignore) car il contient des informations sensibles. Vous ne voulez pas que ces informations soient exposées ou partagées.



     

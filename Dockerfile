# Utilisez une image de base contenant Apache, PHP et le pilote PDO MySQL
FROM php:8.2-apache

# Installez le pilote PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Installez Git
RUN apt-get update && apt-get install -y git

# Installez Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installez Node.js et npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# Installez les dépendances de PHP 
RUN apt-get install -y libzip-dev zip unzip

# Installation CLI de symfony
RUN curl -sS https://get.symfony.com/cli/installer | bash
ENV PATH="/root/.symfony5/bin:${PATH}"

# Copiez vos fichiers PHP dans le répertoire /var/www/html du conteneur
COPY ./ /var/www/html/

# Exposez le port 80 pour le trafic HTTP
EXPOSE 80

# Créez un utilisateur non root avec les bonnes permissions.groupadd permet de créer un groupe d'utilisateurs.l'option -r  
RUN groupadd -r myuser && useradd -r -g myuser myuser

# Assurez-vous que l'utilisateur peut accéder au répertoire /var/www/html
RUN mkdir -p /var/www/html && chown myuser:myuser /var/www/html

# Démarrez Apache lorsque le conteneur démarre
CMD ["apache2-foreground"]

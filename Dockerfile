FROM php:8.5-fpm
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /srv
EXPOSE 80
ENTRYPOINT ["php", "-S", "0.0.0.0:80"]
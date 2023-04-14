FROM php:fpm


# Our stuff
COPY webdir/composer.lock composer.json
COPY webdir/composer.lock composer.lock
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get install -y \
        git \
        unzip 
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer 
RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist
FROM php:fpm
# Our stuff
#RUN addgroup -g ${GID} --system laravel
#RUN adduser -G laravel --system -D -s /bin/sh -u ${UID} laravel
#COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
#CMD "composer require pragmarx/google2fa"
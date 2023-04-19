FROM php:fpm
# Our stuff
#RUN addgroup -g ${GID} --system laravel
#RUN adduser -G laravel --system -D -s /bin/sh -u ${UID} laravel

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

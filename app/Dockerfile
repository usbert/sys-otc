FROM php:8.2-fpm-bullseye

# install the PHP extensions we need
RUN apt-get update && apt-get install -y  libjpeg-dev libxml2-dev  && rm -rf /var/lib/apt/lists/* \
 && docker-php-ext-install  mysqli  soap && docker-php-ext-configure intl \
&& docker-php-ext-install intl

RUN apt-get update && apt-get install -y git openssl libonig-dev libzip-dev zip unzip libmcrypt-dev libxml2-dev \
    libmagickwand-dev librabbitmq-dev  --no-install-recommends supervisor -y

RUN pecl install  mongodb  amqp

RUN docker-php-ext-enable  mongodb  amqp

RUN docker-php-ext-install gd zip   pdo  pdo_mysql  bcmath sockets
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

COPY php.ini /usr/local/etc/php/php.ini

COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN docker-php-ext-install opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install nodejs npm
RUN curl -fsSL https://deb.nodesource.com/setup_19.x | bash - && apt-get install -y nodejs

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php



#VOLUME /var/www/html


# grr, ENTRYPOINT resets CMD now
#ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]

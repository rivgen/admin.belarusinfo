FROM php:7.2-fpm

RUN apt-get update && \
    apt-get install -y --no-install-recommends apt-utils libssl-dev zlib1g-dev curl git bash zip unzip netcat \
    acl dbus openssh-client libzip-dev build-essential zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev libpq-dev libxml2-dev && \
    docker-php-ext-install opcache pdo pdo_mysql mysqli pgsql soap zip mbstring fileinfo iconv pcntl exif intl dba && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN composer self-update 1.4.1

RUN composer --version


# Install yarn
#RUN curl https://deb.nodesource.com/setup_16.x | bash
#RUN curl https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
#RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
#RUN apt-get update && apt-get install -y --no-install-recommends \
#    make nodejs yarn
#
#RUN yarn --version

ADD ./conf.d/php.ini /usr/local/etc/php

ADD ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

WORKDIR /var/www

CMD ["/entrypoint.sh"]
EXPOSE 9000
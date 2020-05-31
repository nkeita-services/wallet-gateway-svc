FROM php:7.3.10-cli

RUN apt-get update \
    && apt-get install -y \
    git zip libcurl4-openssl-dev libssl-dev pkg-config

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install the gmp
RUN apt-get update -y && \
    apt-get install -y libgmp-dev re2c libmhash-dev file && \
    ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/ && \
    docker-php-ext-configure gmp && \
    docker-php-ext-install gmp

# install mongodb ext
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

COPY . /var/www/html/
WORKDIR /var/www/html
RUN composer install

# Use the official PHP 7.3 image.
# https://hub.docker.com/_/php
FROM php:7.3-apache
RUN a2enmod rewrite
RUN a2enmod headers

# Install pdo
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# install mongodb ext
RUN apt-get update
RUN apt-get install -y openssl libssl-dev libcurl4-openssl-dev
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

#Install GD and iconv
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Copy local code to the container image.
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 777 /var/www/html/storage
COPY --from=0 /var/www/html/vendor /var/www/html/vendor

# Use the PORT environment variable in Apache configuration files.
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configure PHP for development.
# Switch to the production php.ini for production operations.
# RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
# https://hub.docker.com/_/php#configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

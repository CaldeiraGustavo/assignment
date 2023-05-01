FROM php:8.1-fpm

# set your user name, ex: user=bernardo
ARG user=carlos
ARG uid=1000

# Install dependencies
RUN apt update -y &&\
    apt install nano -y &&\
    apt-get install libldb-dev libldap2-dev  -y

RUN docker-php-ext-install opcache

RUN apt-get update \
    && apt-get install -y git zlib1g-dev libpng-dev \
    &&  apt-get install libcurl4-gnutls-dev libxml2-dev -y\
    && apt-get install libzip-dev -y\
    && docker-php-ext-install pdo pdo_mysql zip ldap gd curl soap


RUN apt-get install -y libssh2-1-dev libssh2-1 \
    && pecl install ssh2-1.3.1 \
    && docker-php-ext-enable ssh2

RUN apt-get install -y curl \
    && curl -fsSL https://deb.nodesource.com/setup_16.x | bash -
# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*


# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Install redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Set working directory
WORKDIR /var/www

# Copy custom configurations PHP
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

USER $user
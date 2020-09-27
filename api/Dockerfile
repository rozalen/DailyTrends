FROM php:7.4-cli
RUN apt-get update \
    && apt-get install -y \
    libpq-dev \
    vim \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install -j$(nproc) pdo pdo_pgsql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /var/www
WORKDIR /var/www
RUN composer install
CMD php -S 0.0.0.0:8000 -t /var/www/public

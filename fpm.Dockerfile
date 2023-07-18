FROM php:8.1-fpm-buster

# Install packages
RUN apt-get update && \
    apt-get install -y git zip unzip less && \
    rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

COPY composer.json ./
COPY composer.lock ./

# Install composer packages
RUN composer validate --no-check-publish && composer install --no-scripts --no-autoloader

# Install code
COPY . ./

# Install example data
RUN mkdir -p /var/podfather/techtest/storage
COPY ./docker/fpm/example_data/* /var/podfather/techtest/storage
RUN chmod 0666 /var/podfather/techtest/storage/*

# Finish with Composer
RUN composer dump-autoload --optimize && composer run-script post-install-cmd

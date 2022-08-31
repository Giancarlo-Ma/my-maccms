FROM php:7.4-fpm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN apt-get update && \
  apt-get install -y \
  libzip-dev zip\
  && docker-php-ext-install pdo_mysql zip

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Create system user to run Composer and Artisan Commands
# RUN useradd -G www-data,root -u $uid -d /home/$user $user
# RUN mkdir -p /home/$user/.composer && \
#   chown -R $user:$user /home/$user

# # Set working directory
# WORKDIR /var/www

# USER $user

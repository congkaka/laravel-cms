FROM php:8.1.0-apache
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxml2-dev \
    zip \
    unzip \
    p7zip-full \
    git

# 2. Apache configs + document root.
RUN echo "ServerName laravel-app.local" >> /etc/apache2/apache2.conf

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite headers

# 4. Start with base PHP config, then add extensions.
# RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install gd
RUN docker-php-ext-install pdo pdo_pgsql pgsql

# Install composer dependencies
# COPY composer.json composer.lock ./


# COPY . /var/www/html/

# RUN composer install --no-interaction --no-plugins --no-scripts \
#     && php artisan key:generate

# Create storage directory
# RUN mkdir -p storage
# RUN mkdir -p bootstrap
# RUN mkdir -p storage/framework/sessions
# Set permissions for Laravel storage directory
# RUN chmod -R 777 storage
# RUN chmod -R 777 bootstrap
# RUN chmod -R 777 storage/framework/sessions

# RUN if [ -f "/var/www/html/.env" ]; then rm /var/www/html/.env; fi
# RUN mv /var/www/html/.env.production /var/www/html/.env

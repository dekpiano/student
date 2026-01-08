FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    openssl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo_mysql \
    mysqli \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    intl \
    zip \
    opcache

# Configure PHP settings
RUN { \
    echo 'opcache.memory_consumption=512'; \
    echo 'opcache.interned_strings_buffer=64'; \
    echo 'opcache.max_accelerated_files=30000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.validate_timestamps=1'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=1'; \
    echo 'realpath_cache_size=16M'; \
    echo 'realpath_cache_ttl=3600'; \
    echo 'upload_max_filesize=100M'; \
    echo 'post_max_size=110M'; \
    echo 'memory_limit=1024M'; \
    echo 'max_execution_time=600'; \
    } > /usr/local/etc/php/conf.d/docker-php-config.ini

# Enable Apache mod_rewrite and mod_ssl
RUN a2enmod rewrite ssl
RUN a2ensite default-ssl

# Generate Self-Signed Certificate for HTTPS
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout /etc/ssl/private/apache-selfsigned.key \
    -out /etc/ssl/certs/apache-selfsigned.crt \
    -subj "/C=TH/ST=Bangkok/L=Bangkok/O=SkjSystem/OU=IT/CN=localhost"

# Configure SSL to use the generated certificate
RUN sed -i 's!/etc/ssl/certs/ssl-cert-snakeoil.pem!/etc/ssl/certs/apache-selfsigned.crt!g' /etc/apache2/sites-available/default-ssl.conf \
    && sed -i 's!/etc/ssl/private/ssl-cert-snakeoil.key!/etc/ssl/private/apache-selfsigned.key!g' /etc/apache2/sites-available/default-ssl.conf

# Set Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Allow .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Set permissions (Will be handled by volumes in dev, but good for build)
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80 443


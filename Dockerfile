FROM php:8.2-apache

# Install PHP extensions required by Moodle
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libxml2-dev libzip-dev libicu-dev libldap2-dev \
    libonig-dev unzip git curl cron \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd intl mysqli pdo_mysql soap zip opcache \
        mbstring exif \
    && pecl install redis && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# PHP config for Moodle
RUN echo "max_execution_time=300" >> /usr/local/etc/php/conf.d/moodle.ini \
    && echo "max_input_vars=5000" >> /usr/local/etc/php/conf.d/moodle.ini \
    && echo "memory_limit=256M" >> /usr/local/etc/php/conf.d/moodle.ini \
    && echo "post_max_size=128M" >> /usr/local/etc/php/conf.d/moodle.ini \
    && echo "upload_max_filesize=128M" >> /usr/local/etc/php/conf.d/moodle.ini \
    && echo "file_uploads=On" >> /usr/local/etc/php/conf.d/moodle.ini

# OPcache config
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini

# Enable Apache mod_rewrite
RUN a2enmod rewrite headers

# Download Moodle 5.1
RUN curl -L https://download.moodle.org/download.php/direct/stable405/moodle-latest-405.tgz \
    -o /tmp/moodle.tgz \
    && tar xzf /tmp/moodle.tgz -C /tmp \
    && rm -rf /var/www/html/* \
    && mv /tmp/moodle/* /var/www/html/ \
    && rm -rf /tmp/moodle /tmp/moodle.tgz

# Create moodledata
RUN mkdir -p /var/www/moodledata \
    && chown -R www-data:www-data /var/www/moodledata \
    && chown -R www-data:www-data /var/www/html

# Apache config for .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

WORKDIR /var/www/html

EXPOSE 80

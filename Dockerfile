FROM php:8.3-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
        $PHPIZE_DEPS \
        libssl-dev \
        libonig-dev \
        unzip \
        git \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && docker-php-ext-install pdo_mysql mbstring \
    && apt-get purge -y --auto-remove $PHPIZE_DEPS \
    && rm -rf /var/lib/apt/lists/* \
    && a2enmod rewrite

RUN echo "variables_order = EGPCS" > /usr/local/etc/php/conf.d/variables-order.ini
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html/vitegourmand

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-interaction --optimize-autoloader

COPY . .

COPY docker/vhost.conf /etc/apache2/sites-available/vitegourmand.conf
RUN a2dissite 000-default && a2ensite vitegourmand

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]
CMD ["apache2-foreground"]

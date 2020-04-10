FROM php:7

WORKDIR /var/www/html

RUN apt update --fix-missing && \
    apt install -y git && \
    apt install unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    chmod +x /usr/local/bin/composer && \
    apt install libsodium-dev -y && \
    apt install -y libxml2-dev && \
    apt install -y zlib1g-dev && \
    apt install -y libzip-dev zip && \
    docker-php-ext-install sodium && \
    docker-php-ext-install xml && \
    docker-php-ext-install intl && \
    docker-php-ext-install zip

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html/public"]
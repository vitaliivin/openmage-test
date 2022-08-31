FROM php:7.4-apache

ARG MAGE_CA_ROOT_CRT=''

WORKDIR /var/www/api

RUN echo "file_uploads = On" >> /usr/local/etc/php/conf.d/mage.ini &&\
    echo "memory_limit = 128M" >> /usr/local/etc/php/conf.d/mage.ini &&\
    echo "upload_max_filesize = 50M" >> /usr/local/etc/php/conf.d/mage.ini &&\
    echo "post_max_size = 1M" >> /usr/local/etc/php/conf.d/mage.ini &&\
    echo "max_execution_time = 300" >> /usr/local/etc/php/conf.d/mage.ini &&\
    mkdir cache logs /.opcache && chown www-data:www-data cache logs /.opcache && chmod 0700 cache logs /.opcache

RUN apt-get install -yq --no-install-recommends &&\
    docker-php-ext-configure opcache --enable-opcache &&\
    docker-php-ext-install mysqli pdo pdo_mysql opcache &&\
    echo "opcache.enable=0" >> /usr/local/etc/php/conf.d/opcache.ini &&\
    echo "opcache.enable_cli=1" >> /usr/local/etc/php/conf.d/opcache.ini &&\
    echo "opcache.file_cache='/.opcache'" >> /usr/local/etc/php/conf.d/opcache.ini &&\
    echo "opcache.revalidate_path=0" >> /usr/local/etc/php/conf.d/opcache.ini &&\
    echo "opcache.max_file_size=0" >> /usr/local/etc/php/conf.d/opcache.ini &&\
    echo "opcache.max_accelerated_files=4000" >> /usr/local/etc/php/conf.d/opcache.ini &&\
    echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini &&\
    echo "opcache.error_log='/proc/self/fd/2'" >> /usr/local/etc/php/conf.d/opcache.ini &&\
    echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini &&\
    echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini &&\
    echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/opcache.ini &&\
    pecl install redis &&\
    docker-php-ext-enable redis

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev libpng-dev libxml2-dev

RUN docker-php-ext-install gd soap

ADD ${MAGE_CA_ROOT_CRT} /usr/local/share/ca-certificates/mage-ca-root.crt
RUN chmod 644 /usr/local/share/ca-certificates/mage-ca-root.crt && \
    apt-get install -yq ca-certificates && \
    update-ca-certificates

COPY ./config/apache2/openmage-test.dev.conf /etc/apache2/sites-available/openmage-test.dev.conf
COPY ./config/apache2/hosts /etc/hosts
RUN a2ensite openmage-test.dev.conf
RUN a2enmod ssl

USER www-data

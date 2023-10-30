FROM php:8-fpm
ARG DEBIAN_FRONTEND=noninteractive

# install necesar packages
RUN apt-get update && apt-get install -y \
        libicu-dev \
        libpq-dev \
        libbz2-dev \
        git \
        unzip \
        mc \
        vim \
        wget \
        libevent-dev \
        libc-client2007e-dev \
        libkrb5-dev \
        krb5-config \
        krb5-user \
        libpam-krb5 \
        krb5-multidev \
        poppler-utils \
        unixodbc-dev \
        freetds-dev \
        librabbitmq-dev \
        libmemcached-dev \
        openssh-server \
        && docker-php-ext-install pdo_mysql \
        && docker-php-ext-install bcmath \
        && docker-php-ext-install opcache \
        && docker-php-ext-enable opcache

RUN CFLAGS="$CFLAGS -D_GNU_SOURCE" docker-php-ext-install -j$(nproc) sockets

RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap


WORKDIR /var/www/api.grapefruit

# sending the log errors to docker interface log
RUN ln -sf /dev/stdout /var/log/access.log && ln -sf /dev/stderr /var/log/error.log




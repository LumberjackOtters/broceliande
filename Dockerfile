FROM php:8.1-fpm-alpine

RUN apk add autoconf bash build-base libmcrypt libmcrypt-dev libldap php81-ldap openldap-dev
RUN pecl install mcrypt-1.0.6
# RUN docker-php-ext-configure ldap --with-libdir=lib/$(gcc -dumpmachine)
RUN docker-php-ext-install ldap
RUN docker-php-ext-enable mcrypt
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer && \
    curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash && \
    apk add symfony-cli

ENTRYPOINT ["docker-php-entrypoint"]
CMD ["php-fpm"]
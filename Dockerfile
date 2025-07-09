FROM php:8.2-apache

# Instala extensões necessárias para MySQL, intl e outras dependências comuns do CodeIgniter
RUN apt-get update && apt-get install -y libicu-dev && docker-php-ext-install pdo pdo_mysql mysqli intl

# Instala Xdebug para cobertura de código
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Habilita o Apache mod_rewrite (importante para CodeIgniter)
RUN a2enmod rewrite

# Define o diretório público do Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Atualiza o VirtualHost do Apache para usar o novo DocumentRoot
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html 
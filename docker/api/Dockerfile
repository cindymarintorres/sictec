FROM php:8.4-cli-alpine

# Dependencias del sistema necesarias para las extensiones de PHP y Postgres
RUN apk add --no-cache \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    oniguruma-dev \
    $PHPIZE_DEPS \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip mbstring

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

EXPOSE 8000

# El código real se monta como volumen en desarrollo (ver docker-compose.yaml).
# composer install y las migraciones corren en el "command" del compose,
# no aquí, para no depender de variables de entorno en build time.
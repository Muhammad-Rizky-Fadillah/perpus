FROM php:8.3-cli

# 1. Install sistem dependensi termasuk library untuk GD
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev

# 2. Konfigurasi dan Install ekstensi PHP (termasuk GD)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mysqli zip gd

# Install Node.js 20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install
# Catatan: Laravel modern menggunakan Vite (npm run build). 
# Jika Anda masih menggunakan Laravel Mix, tetap gunakan npm run production.
RUN npm run build || npm run production

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libfontconfig1 \
    libxrender1 \
    libxext6 \
    fonts-dejavu-core \
    libwebp-dev \
    && rm -rf /var/lib/apt/lists/*

# =========================
# INSTALL GD (FORCE VALIDATED)
# =========================
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp

RUN docker-php-ext-install -j$(nproc) gd

# VERIFY GD INSTALLED (INI PENTING)
RUN php -m | grep gd

# =========================
# LARAVEL EXTENSIONS
# =========================
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000

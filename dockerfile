FROM php:8.2-fpm

# =========================
# SYSTEM DEPENDENCIES
# =========================
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
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
# GD EXTENSION (FIXED - RAILWAY SAFE)
# =========================
RUN docker-php-ext-configure gd \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/ \
    --with-webp

RUN docker-php-ext-install -j$(nproc) gd

# VERIFY GD
RUN php -m | grep gd

# =========================
# PHP EXTENSIONS
# =========================
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    zip

# =========================
# COMPOSER
# =========================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
FROM php:8.3-cli

# =========================
# SYSTEM DEPENDENCIES
# =========================
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    libonig-dev \
    build-essential \
    autoconf \
    pkg-config \
    gnupg \
    && rm -rf /var/lib/apt/lists/*

# =========================
# PHP EXTENSIONS
# =========================
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli \
    mbstring \
    exif \
    zip

# =========================
# GD EXTENSION (IMPORTANT FOR DOMPDF)
# =========================
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp

RUN docker-php-ext-install -j$(nproc) gd

# VERIFY GD
RUN php -m | grep gd

# =========================
# NODEJS 20
# =========================
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# =========================
# COMPOSER
# =========================
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# =========================
# INSTALL DEPENDENCIES
# =========================
RUN composer install --no-dev --optimize-autoloader

RUN npm install
RUN npm run production

# =========================
# PERMISSION
# =========================
RUN chmod -R 775 storage bootstrap/cache

# =========================
# PORT
# =========================
EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
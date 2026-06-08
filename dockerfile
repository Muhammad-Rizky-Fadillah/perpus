FROM php:8.2-fpm

# =========================
# Install system dependencies
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
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# =========================
# Install PHP extensions
# =========================
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    && docker-php-ext-install gd

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    zip

# =========================
# Install Composer
# =========================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# =========================
# Set working directory
# =========================
WORKDIR /var/www

# =========================
# Copy project
# =========================
COPY . .

# =========================
# Install dependencies
# =========================
RUN composer install --no-dev --optimize-autoloader

# =========================
# Permissions (IMPORTANT)
# =========================
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# =========================
# Expose port
# =========================
EXPOSE 8000

# =========================
# Run Laravel
# =========================
CMD php artisan serve --host=0.0.0.0 --port=8000
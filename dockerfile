FROM php:8.2.31-cli

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    pkg-config

RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

RUN docker-php-ext-install -j$(nproc) gd

RUN php --ri gd

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli \
    bcmath \
    exif \
    zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

RUN npm ci || npm install
RUN npm run build || npm run production || true

EXPOSE 8080

CMD ["sh", "-c", "php --ri gd && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
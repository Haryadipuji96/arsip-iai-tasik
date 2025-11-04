# Gunakan image PHP 8.2 dengan Apache
FROM php:8.2-apache

# Install ekstensi PHP yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd mbstring exif pcntl bcmath opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy semua file project ke dalam container
COPY . .

# Install dependensi Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy file .env.example jadi .env (kalau belum ada)
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Generate APP_KEY
RUN php artisan key:generate || true

# Beri izin folder penting
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port (Render otomatis pakai PORT variabel)
EXPOSE 8080

# Jalankan Laravel dengan php artisan serve
CMD php artisan serve --host=0.0.0.0 --port=$PORT

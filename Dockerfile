# Gunakan image PHP 8.2 dengan Apache
FROM php:8.2-apache

# Install ekstensi yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd mbstring exif pcntl bcmath opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy semua file project Laravel ke dalam container
COPY . .

# Install dependensi Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Generate key saat pertama kali build
RUN php artisan key:generate || true

# Beri izin akses untuk storage dan cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port Laravel
EXPOSE 10000

# Jalankan Laravel pakai Artisan
CMD php artisan serve --host=0.0.0.0 --port=10000

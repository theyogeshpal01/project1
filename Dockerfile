FROM php:8.2-apache

# 1. Install tools needed for Composer (zip, unzip, git)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# 2. Install MySQL extensions so your database connection works
RUN docker-php-ext-install mysqli pdo pdo_mysql mbstring

# 3. Install Composer (the tool that creates the vendor folder)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 4. Set the working folder
WORKDIR /var/www/html

# 5. Copy your composer files and run install
# This creates the 'vendor' folder and 'autoload.php'
COPY composer.json composer.lock* ./
RUN composer install --no-dev --optimize-autoloader

# 6. Copy all your other project files
COPY . /var/www/html/

# 7. Enable Apache rewrite (fixes potential 404 errors)
RUN a2enmod rewrite

# 8. Create uploads directory and set permissions
RUN mkdir -p /var/www/html/uploads && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html/uploads

EXPOSE 80
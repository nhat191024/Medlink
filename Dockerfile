FROM php:8.4-apache

# Update package list and install dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    libpng-dev \
    libpq-dev \
    # nodejs \
    # npm \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install zip pdo_mysql gd bcmath intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Xóa cache của apt để giảm kích thước image
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Bật mod_rewrite cho Apache
RUN a2enmod rewrite

# Copy cấu hình redirect HTTP -> HTTPS
COPY 000-default-redirect.conf /etc/apache2/sites-available/000-default.conf

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

COPY . /var/www/html

# Sao chép mã nguồn của ứng dụng vào container
WORKDIR /var/www/html

# Sao chép entrypoint.sh vào container
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Đặt entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]

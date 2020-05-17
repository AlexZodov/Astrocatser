FROM php:7.4-fpm
USER root
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd
# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
# Install extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql tokenizer pcntl
# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
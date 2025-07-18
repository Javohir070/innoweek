# Base image
FROM php:8.3-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zlib1g-dev \
    libicu-dev \
    g++ \
    libxslt-dev \
    cron \
    libpq-dev \
    nano \
    wget \
    pkg-config \
    libopencv-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

#RUN wget https://raw.githubusercontent.com/php-opencv/php-opencv-packages/master/opencv_4.7.0_amd64.deb && dpkg -i opencv_4.7.0_amd64.deb && rm opencv_4.7.0_amd64.deb

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl bcmath opcache intl xsl

# Install PHP-OpenCV
RUN git clone https://github.com/php-opencv/php-opencv.git /usr/src/php/ext/opencv \
    && docker-php-ext-install opencv

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# # Copy entrypoint script
#COPY entrypoint.sh /usr/local/bin/entrypoint.sh
# # Make entrypoint script executable
#RUN chmod +x /usr/local/bin/entrypoint.sh
# Copy existing application directory contents

#php
ADD php/php.ini  /usr/local/etc/php/php.ini
#ADD php/php-fpm.d/docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf


# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install npm and any dependencies
RUN npm install -g npm

# Copy existing application directory contents
COPY . .

RUN composer install

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Change current user to www
#USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
#ENTRYPOINT [ "entrypoint.sh" ]
CMD ["php-fpm"]

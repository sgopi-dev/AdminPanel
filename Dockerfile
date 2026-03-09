# ---------- Stage 1 : Composer Dependencies ----------
FROM composer:2 AS composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    # --no-dev \
    --no-interaction \
    --prefer-dist \
    --ignore-platform-reqs \
    --no-scripts


# ---------- Stage 2 : Build Frontend ----------
FROM node:20 AS node

WORKDIR /app

COPY package.json package-lock.json ./

RUN npm install

COPY resources resources
COPY *.js .

RUN npm run build


# ---------- Stage 3 : Final Runtime ----------
FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    sqlite3 \
    libsqlite3-dev \
    libzip-dev \
    zip

RUN docker-php-ext-install pdo pdo_sqlite zip

WORKDIR /var/www

# Copy Laravel source
COPY . .

# Copy vendor from composer stage
COPY --from=composer /app/vendor ./vendor

# Copy built assets
COPY --from=node /app/public/build ./public/build

# Environment setup
RUN cp .env.example .env

RUN php artisan key:generate

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 8000

# Set the entrypoint script
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
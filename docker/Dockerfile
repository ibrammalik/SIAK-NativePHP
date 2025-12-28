# Stage 1: Vendor (shared between all)
FROM php:8.3-cli-alpine AS vendor

RUN apk add --no-cache git unzip curl \
 && curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

# Install PHP extensions (needed for composer)
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd bcmath intl pcntl redis pdo_mysql zip

COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts --no-progress --optimize-autoloader 

# Stage 2: Assets (build frontend with Node 22 + Yarn)
FROM node:22-alpine AS assets
WORKDIR /app

# Copy dependency manifests and install dependencies using Yarn (via Corepack)
# COPY package.json yarn.lock ./
COPY package.json ./
RUN corepack enable \
    && corepack prepare yarn@1.22.22 --activate \
    && yarn install --frozen-lockfile

# Copy only what is needed for building assets
# COPY tailwind.config.js ./
# COPY postcss.config.js ./
COPY app ./app
COPY vite.config.js ./
COPY resources ./resources
COPY public ./public
COPY --from=vendor /app/vendor /app/vendor

ENV NODE_ENV=production
RUN yarn build

# Stage 3: Worker image (CLI)
FROM php:8.3-cli-alpine AS worker
COPY --from=vendor /usr/local/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions bcmath intl pcntl gd curl pdo_mysql mbstring redis zip

ARG APP_ENV=production
WORKDIR /app
COPY . /app
COPY ".env.${APP_ENV:-production}" .env
COPY --from=vendor /app/vendor /app/vendor

RUN mkdir -p storage bootstrap/cache;
RUN chown -R www-data:www-data storage bootstrap/cache;
RUN chmod -R 775 storage bootstrap/cache;

# USER www-data
CMD ["php", "artisan", "queue:work", "--tries=3", "--sleep=1"]

# Stage 4: FrankenPHP image (Web)
FROM dunglas/frankenphp:1.4-php8.3 AS frankenphp
WORKDIR /app

ARG APP_ENV=production
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN install-php-extensions bcmath intl pcntl gd curl pdo_mysql mbstring redis zip

COPY . /app
COPY ".env.${APP_ENV:-production}" .env
COPY --from=vendor /app/vendor /app/vendor

# Copy compiled frontend assets without installing Node/Yarn in this stage
COPY --from=assets /app/public/build /app/public/build

COPY --from=vendor /usr/local/bin/install-php-extensions /usr/local/bin/install-php-extensions
COPY --from=vendor /usr/local/bin/composer /usr/local/bin/composer

RUN mkdir -p storage bootstrap/cache;
RUN chown -R www-data:www-data storage bootstrap/cache;
RUN chmod -R 775 storage bootstrap/cache;

#EXPOSE 80
CMD ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=80"]
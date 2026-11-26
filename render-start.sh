#!/usr/bin/env bash
set -e

mkdir -p database storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache public/uploads/varan-photos
touch database/database.sqlite
chmod -R 777 storage bootstrap/cache database public/uploads

if [ ! -f .env ] && [ -f .env.example ]; then
  cp .env.example .env
fi

if [ -z "${APP_KEY}" ]; then
  php artisan key:generate --force || true
fi

php artisan storage:link || true
php artisan migrate --force
php artisan db:seed --force
php artisan optimize:clear

PORT_TO_USE="${PORT:-10000}"
echo "Starting Master Matrimony server on 0.0.0.0:${PORT_TO_USE}"
exec php -S "0.0.0.0:${PORT_TO_USE}" -t public public/index.php

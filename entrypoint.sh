#!/bin/sh
set -e

echo "🚀 Laravel starting..."

sleep 10

php artisan config:clear || true
php artisan key:generate --force || true
php artisan migrate --force || true
php artisan db:seed --force || true

php artisan optimize:clear || true

echo "✅ App ready"

exec "$@"

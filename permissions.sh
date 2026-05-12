#!/bin/sh

set -e

echo "Fixing Laravel permissions..."

# Main app ownership
docker compose exec app sh -c "chown -R 1000:1000 /var/www/html"

# Laravel writable directories
docker compose exec app sh -c "mkdir -p /var/www/html/storage \
         /var/www/html/bootstrap/cache"

docker compose exec app sh -c "chmod -R ug+rwx /var/www/html/storage"
docker compose exec app sh -c "chmod -R ug+rwx /var/www/html/bootstrap/cache"

# Optional cache/session/log dirs
docker compose exec app sh -c "mkdir -p /var/www/html/storage/framework/{cache,sessions,views}"
docker compose exec app sh -c "mkdir -p /var/www/html/storage/logs"

# Web server ownership
docker compose exec app sh -c "chown -R www-data:www-data /var/www/html/storage"
docker compose exec app sh -c "chown -R www-data:www-data /var/www/html/bootstrap/cache"

# Artisan executable
docker compose exec app sh -c "chmod +x /var/www/html/artisan"

# Optional: node_modules writable (if using Vite inside container)
if [ -d "/var/www/html/node_modules" ]; then
    docker compose exec app sh -c "chmod -R ug+rwx /var/www/html/node_modules"
fi

echo "Laravel permissions fixed."

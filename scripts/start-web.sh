#!/usr/bin/env sh
set -eu

require_env() {
    name="$1"
    value="$(printenv "$name" || true)"

    if [ -z "$value" ]; then
        echo "Missing required environment variable: $name" >&2
        exit 1
    fi
}

require_env APP_KEY
require_env APP_URL
require_env DB_CONNECTION

if [ "$DB_CONNECTION" = "mysql" ]; then
    require_env DB_HOST
    require_env DB_PORT
    require_env DB_DATABASE
    require_env DB_USERNAME
    require_env DB_PASSWORD
fi

php artisan optimize:clear
php artisan migrate --force
php artisan storage:link || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec heroku-php-apache2 public/

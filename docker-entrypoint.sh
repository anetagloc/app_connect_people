#!/bin/bash
set -e

echo "🚀 Starting Laravel application..."

# If DATABASE_URL is set (Render PostgreSQL), use pgsql connection
if [ -n "$DATABASE_URL" ]; then
    echo "📦 Detected DATABASE_URL, using PostgreSQL..."
    export DB_CONNECTION=pgsql
    
    echo "📦 Running database migrations..."
    php artisan migrate --force
fi

# Generate Swagger documentation
echo "📝 Generating Swagger API docs..."
php artisan l5-swagger:generate

# Cache configuration for production
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the application
echo "🌐 Starting server on port $PORT..."
exec php artisan serve --host=0.0.0.0 --port=${PORT:-10000}

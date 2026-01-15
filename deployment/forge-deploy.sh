#!/bin/bash
# =============================================================================
# Laravel Forge Deployment Script - Ulixai
# =============================================================================
# Copier ce script dans Forge → Site → Deployment Script
# =============================================================================

cd /home/forge/ulixai.com

# Pull latest changes
git pull origin $FORGE_SITE_BRANCH

# Install dependencies (without dev)
$FORGE_COMPOSER install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Run database migrations
$FORGE_PHP artisan migrate --force

# Clear and rebuild all caches
$FORGE_PHP artisan config:cache
$FORGE_PHP artisan route:cache
$FORGE_PHP artisan view:cache
$FORGE_PHP artisan event:cache

# Clear old cache
$FORGE_PHP artisan cache:clear

# Restart queue workers (graceful restart)
$FORGE_PHP artisan queue:restart

# Optional: Run npm build if you have frontend assets
# npm ci --production
# npm run build

echo "✅ Deployment completed successfully!"

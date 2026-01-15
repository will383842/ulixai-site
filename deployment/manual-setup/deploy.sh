#!/bin/bash
# =============================================================================
# Deployment Script for Ulixai - Production
# =============================================================================
# Usage: ./deploy.sh [--first-run]
# =============================================================================

set -e

# =============================================================================
# Configuration
# =============================================================================
APP_DIR="/var/www/ulixai.com"
REPO_URL="git@github.com:YOUR_USERNAME/ulixai-site.git"
BRANCH="main"
PHP_VERSION="8.3"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# =============================================================================
# Functions
# =============================================================================
log_info() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

log_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

log_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

log_error() {
    echo -e "${RED}[ERROR]${NC} $1"
    exit 1
}

# =============================================================================
# First Run Installation
# =============================================================================
first_run_install() {
    log_info "=== FIRST RUN INSTALLATION ==="

    # Update system
    log_info "Updating system packages..."
    apt update && apt upgrade -y

    # Install required packages
    log_info "Installing required packages..."
    apt install -y \
        nginx \
        mysql-server \
        redis-server \
        supervisor \
        certbot python3-certbot-nginx \
        git \
        unzip \
        curl \
        software-properties-common

    # Add PHP repository
    log_info "Adding PHP repository..."
    add-apt-repository ppa:ondrej/php -y
    apt update

    # Install PHP and extensions
    log_info "Installing PHP ${PHP_VERSION}..."
    apt install -y \
        php${PHP_VERSION}-fpm \
        php${PHP_VERSION}-mysql \
        php${PHP_VERSION}-redis \
        php${PHP_VERSION}-xml \
        php${PHP_VERSION}-curl \
        php${PHP_VERSION}-mbstring \
        php${PHP_VERSION}-zip \
        php${PHP_VERSION}-gd \
        php${PHP_VERSION}-intl \
        php${PHP_VERSION}-bcmath \
        php${PHP_VERSION}-opcache

    # Install Composer
    log_info "Installing Composer..."
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer

    # Create app directory
    log_info "Creating application directory..."
    mkdir -p ${APP_DIR}
    chown -R www-data:www-data ${APP_DIR}

    # Create log directories
    mkdir -p /var/log/php-fpm
    mkdir -p /var/log/nginx

    # Clone repository
    log_info "Cloning repository..."
    cd /var/www
    git clone ${REPO_URL} ulixai.com
    cd ${APP_DIR}

    # Set permissions
    chown -R www-data:www-data ${APP_DIR}
    chmod -R 755 ${APP_DIR}
    chmod -R 775 ${APP_DIR}/storage
    chmod -R 775 ${APP_DIR}/bootstrap/cache

    # Copy configuration files
    log_info "Copying configuration files..."
    cp ${APP_DIR}/deployment/nginx.conf /etc/nginx/sites-available/ulixai.com
    ln -sf /etc/nginx/sites-available/ulixai.com /etc/nginx/sites-enabled/
    rm -f /etc/nginx/sites-enabled/default

    cp ${APP_DIR}/deployment/supervisor.conf /etc/supervisor/conf.d/ulixai.conf
    cp ${APP_DIR}/deployment/php-fpm.conf /etc/php/${PHP_VERSION}/fpm/pool.d/ulixai.conf

    # Install dependencies
    log_info "Installing Composer dependencies..."
    cd ${APP_DIR}
    sudo -u www-data composer install --no-dev --optimize-autoloader

    # Setup environment
    log_info "Setting up environment..."
    if [ ! -f "${APP_DIR}/.env" ]; then
        cp ${APP_DIR}/.env.production ${APP_DIR}/.env
        log_warning "Please edit .env with your production values!"
    fi

    # Generate app key
    sudo -u www-data php artisan key:generate

    # Run migrations
    log_info "Running migrations..."
    sudo -u www-data php artisan migrate --force

    # Optimize Laravel
    log_info "Optimizing Laravel..."
    sudo -u www-data php artisan config:cache
    sudo -u www-data php artisan route:cache
    sudo -u www-data php artisan view:cache
    sudo -u www-data php artisan event:cache

    # Setup SSL (comment out if not ready)
    # log_info "Setting up SSL..."
    # certbot --nginx -d ulixai.com -d www.ulixai.com --non-interactive --agree-tos -m admin@ulixai.com

    # Start services
    log_info "Starting services..."
    systemctl enable nginx php${PHP_VERSION}-fpm redis-server supervisor
    systemctl restart nginx php${PHP_VERSION}-fpm redis-server supervisor

    supervisorctl reread
    supervisorctl update

    log_success "=== FIRST RUN INSTALLATION COMPLETE ==="
    log_info "Next steps:"
    log_info "1. Edit /var/www/ulixai.com/.env with production values"
    log_info "2. Setup SSL: certbot --nginx -d ulixai.com -d www.ulixai.com"
    log_info "3. Configure firewall: ufw allow 'Nginx Full' && ufw enable"
}

# =============================================================================
# Regular Deployment (Zero-downtime)
# =============================================================================
deploy() {
    log_info "=== STARTING DEPLOYMENT ==="

    cd ${APP_DIR}

    # Maintenance mode
    log_info "Enabling maintenance mode..."
    php artisan down --render="errors::503" || true

    # Pull latest changes
    log_info "Pulling latest changes from ${BRANCH}..."
    git fetch origin
    git reset --hard origin/${BRANCH}

    # Install dependencies
    log_info "Installing dependencies..."
    composer install --no-dev --optimize-autoloader --no-interaction

    # Run migrations
    log_info "Running migrations..."
    php artisan migrate --force

    # Clear and rebuild caches
    log_info "Rebuilding caches..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache

    # Clear application cache
    php artisan cache:clear

    # Restart queue workers (graceful)
    log_info "Restarting queue workers..."
    php artisan queue:restart

    # Restart PHP-FPM (reload config without dropping connections)
    log_info "Reloading PHP-FPM..."
    systemctl reload php${PHP_VERSION}-fpm

    # Disable maintenance mode
    log_info "Disabling maintenance mode..."
    php artisan up

    log_success "=== DEPLOYMENT COMPLETE ==="
}

# =============================================================================
# Rollback
# =============================================================================
rollback() {
    log_info "=== STARTING ROLLBACK ==="

    cd ${APP_DIR}

    # Get previous commit
    PREVIOUS_COMMIT=$(git rev-parse HEAD~1)

    log_warning "Rolling back to: ${PREVIOUS_COMMIT}"

    php artisan down || true

    git reset --hard ${PREVIOUS_COMMIT}

    composer install --no-dev --optimize-autoloader --no-interaction
    php artisan migrate --force
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan queue:restart
    systemctl reload php${PHP_VERSION}-fpm

    php artisan up

    log_success "=== ROLLBACK COMPLETE ==="
}

# =============================================================================
# Health Check
# =============================================================================
health_check() {
    log_info "=== HEALTH CHECK ==="

    # Check services
    echo ""
    log_info "Services Status:"
    systemctl is-active --quiet nginx && log_success "Nginx: Running" || log_error "Nginx: Stopped"
    systemctl is-active --quiet php${PHP_VERSION}-fpm && log_success "PHP-FPM: Running" || log_error "PHP-FPM: Stopped"
    systemctl is-active --quiet redis-server && log_success "Redis: Running" || log_error "Redis: Stopped"
    systemctl is-active --quiet mysql && log_success "MySQL: Running" || log_error "MySQL: Stopped"
    systemctl is-active --quiet supervisor && log_success "Supervisor: Running" || log_error "Supervisor: Stopped"

    # Check queue workers
    echo ""
    log_info "Queue Workers:"
    supervisorctl status ulixai-workers:*

    # Check disk space
    echo ""
    log_info "Disk Space:"
    df -h /

    # Check memory
    echo ""
    log_info "Memory Usage:"
    free -h

    # Check Redis
    echo ""
    log_info "Redis Info:"
    redis-cli info memory | grep used_memory_human
    redis-cli info clients | grep connected_clients

    # Check Laravel
    echo ""
    log_info "Laravel Status:"
    cd ${APP_DIR}
    php artisan about --only=environment 2>/dev/null || log_warning "Laravel about command not available"
}

# =============================================================================
# Main
# =============================================================================
case "$1" in
    --first-run)
        if [ "$EUID" -ne 0 ]; then
            log_error "First run must be executed as root"
        fi
        first_run_install
        ;;
    --rollback)
        rollback
        ;;
    --health)
        health_check
        ;;
    *)
        deploy
        ;;
esac

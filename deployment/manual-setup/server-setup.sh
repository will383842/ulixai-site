#!/bin/bash
# =============================================================================
# Server Initial Setup Script for Hetzner - Ubuntu 24.04
# =============================================================================
# Run as root: curl -sSL https://raw.githubusercontent.com/YOUR_REPO/main/deployment/server-setup.sh | bash
# =============================================================================

set -e

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

log_info() { echo -e "${BLUE}[INFO]${NC} $1"; }
log_success() { echo -e "${GREEN}[SUCCESS]${NC} $1"; }
log_warning() { echo -e "${YELLOW}[WARNING]${NC} $1"; }

# =============================================================================
# Configuration
# =============================================================================
PHP_VERSION="8.3"
SWAP_SIZE="2G"

log_info "=== HETZNER SERVER INITIAL SETUP ==="

# =============================================================================
# System Update
# =============================================================================
log_info "Updating system..."
apt update && apt upgrade -y

# =============================================================================
# Create Swap (Hetzner VPS n'en a pas par défaut)
# =============================================================================
if [ ! -f /swapfile ]; then
    log_info "Creating ${SWAP_SIZE} swap file..."
    fallocate -l ${SWAP_SIZE} /swapfile
    chmod 600 /swapfile
    mkswap /swapfile
    swapon /swapfile
    echo '/swapfile none swap sw 0 0' >> /etc/fstab

    # Optimiser le swappiness
    echo 'vm.swappiness=10' >> /etc/sysctl.conf
    sysctl -p
    log_success "Swap created"
fi

# =============================================================================
# Essential Packages
# =============================================================================
log_info "Installing essential packages..."
apt install -y \
    software-properties-common \
    apt-transport-https \
    ca-certificates \
    curl \
    wget \
    git \
    unzip \
    htop \
    ncdu \
    net-tools \
    fail2ban \
    ufw

# =============================================================================
# Add PHP Repository
# =============================================================================
log_info "Adding PHP repository..."
add-apt-repository ppa:ondrej/php -y
apt update

# =============================================================================
# Install Nginx
# =============================================================================
log_info "Installing Nginx..."
apt install -y nginx
systemctl enable nginx

# =============================================================================
# Install PHP
# =============================================================================
log_info "Installing PHP ${PHP_VERSION}..."
apt install -y \
    php${PHP_VERSION}-fpm \
    php${PHP_VERSION}-cli \
    php${PHP_VERSION}-common \
    php${PHP_VERSION}-mysql \
    php${PHP_VERSION}-pgsql \
    php${PHP_VERSION}-redis \
    php${PHP_VERSION}-xml \
    php${PHP_VERSION}-xmlrpc \
    php${PHP_VERSION}-curl \
    php${PHP_VERSION}-gd \
    php${PHP_VERSION}-imagick \
    php${PHP_VERSION}-mbstring \
    php${PHP_VERSION}-zip \
    php${PHP_VERSION}-bcmath \
    php${PHP_VERSION}-intl \
    php${PHP_VERSION}-readline \
    php${PHP_VERSION}-opcache \
    php${PHP_VERSION}-soap \
    php${PHP_VERSION}-msgpack \
    php${PHP_VERSION}-igbinary

systemctl enable php${PHP_VERSION}-fpm

# =============================================================================
# Install MySQL 8
# =============================================================================
log_info "Installing MySQL 8..."
apt install -y mysql-server
systemctl enable mysql

# =============================================================================
# Install Redis
# =============================================================================
log_info "Installing Redis..."
apt install -y redis-server
systemctl enable redis-server

# Configurer Redis pour la production
cat >> /etc/redis/redis.conf << 'EOF'

# Production settings
maxmemory 512mb
maxmemory-policy allkeys-lru
EOF

systemctl restart redis-server

# =============================================================================
# Install Supervisor
# =============================================================================
log_info "Installing Supervisor..."
apt install -y supervisor
systemctl enable supervisor

# =============================================================================
# Install Certbot
# =============================================================================
log_info "Installing Certbot..."
apt install -y certbot python3-certbot-nginx

# =============================================================================
# Install Composer
# =============================================================================
log_info "Installing Composer..."
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
chmod +x /usr/local/bin/composer

# =============================================================================
# Install Node.js (pour build assets si nécessaire)
# =============================================================================
log_info "Installing Node.js 20 LTS..."
curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
apt install -y nodejs

# =============================================================================
# Configure PHP for Production
# =============================================================================
log_info "Configuring PHP for production..."

# php.ini optimizations
PHP_INI="/etc/php/${PHP_VERSION}/fpm/php.ini"
sed -i 's/memory_limit = .*/memory_limit = 256M/' ${PHP_INI}
sed -i 's/upload_max_filesize = .*/upload_max_filesize = 50M/' ${PHP_INI}
sed -i 's/post_max_size = .*/post_max_size = 50M/' ${PHP_INI}
sed -i 's/max_execution_time = .*/max_execution_time = 60/' ${PHP_INI}
sed -i 's/;opcache.enable=.*/opcache.enable=1/' ${PHP_INI}
sed -i 's/;opcache.memory_consumption=.*/opcache.memory_consumption=256/' ${PHP_INI}
sed -i 's/;opcache.validate_timestamps=.*/opcache.validate_timestamps=0/' ${PHP_INI}

# =============================================================================
# Configure Firewall
# =============================================================================
log_info "Configuring firewall..."
ufw default deny incoming
ufw default allow outgoing
ufw allow OpenSSH
ufw allow 'Nginx Full'
ufw --force enable

# =============================================================================
# Configure Fail2ban
# =============================================================================
log_info "Configuring Fail2ban..."
cat > /etc/fail2ban/jail.local << 'EOF'
[DEFAULT]
bantime = 3600
findtime = 600
maxretry = 5

[sshd]
enabled = true

[nginx-http-auth]
enabled = true

[nginx-limit-req]
enabled = true
EOF

systemctl enable fail2ban
systemctl restart fail2ban

# =============================================================================
# Create www-data home directory
# =============================================================================
log_info "Setting up www-data user..."
mkdir -p /var/www
chown -R www-data:www-data /var/www

# =============================================================================
# Create log directories
# =============================================================================
mkdir -p /var/log/php-fpm
chown www-data:www-data /var/log/php-fpm

# =============================================================================
# Security hardening
# =============================================================================
log_info "Applying security hardening..."

# Disable root SSH login (après avoir configuré un autre user)
# sed -i 's/PermitRootLogin yes/PermitRootLogin no/' /etc/ssh/sshd_config

# Secure shared memory
echo "tmpfs /run/shm tmpfs defaults,noexec,nosuid 0 0" >> /etc/fstab

# =============================================================================
# Automatic security updates
# =============================================================================
log_info "Configuring automatic security updates..."
apt install -y unattended-upgrades
dpkg-reconfigure -plow unattended-upgrades

# =============================================================================
# Summary
# =============================================================================
echo ""
log_success "=== SERVER SETUP COMPLETE ==="
echo ""
log_info "Installed components:"
echo "  - Nginx"
echo "  - PHP ${PHP_VERSION} + extensions"
echo "  - MySQL 8"
echo "  - Redis"
echo "  - Supervisor"
echo "  - Certbot"
echo "  - Composer"
echo "  - Node.js 20"
echo "  - Fail2ban"
echo "  - UFW Firewall"
echo ""
log_info "Next steps:"
echo "  1. Create a deploy user: adduser deploy && usermod -aG www-data deploy"
echo "  2. Configure MySQL: mysql_secure_installation"
echo "  3. Create database and user"
echo "  4. Deploy your application"
echo "  5. Setup SSL: certbot --nginx -d yourdomain.com"
echo ""
log_warning "Remember to:"
echo "  - Change MySQL root password"
echo "  - Disable root SSH login after creating deploy user"
echo "  - Configure .env with production values"

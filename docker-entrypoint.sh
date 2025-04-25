#!/bin/sh
# Nginx ve PHP-FPM'i arka planda başlat
/start.sh &

# Nginx'in başlamasını bekle
sleep 5

# Laravel gerekli dizinleri oluştur
mkdir -p /var/www/html/storage/app/public
mkdir -p /var/www/html/storage/app/livewire-tmp
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

# Dosya izinlerini ayarla
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Livewire geçici dosya yükleme dizinini oluştur ve izinlerini ayarla
mkdir -p /var/www/html/storage/app/livewire-tmp
chmod -R 777 /var/www/html/storage/app/livewire-tmp

# Storage symlink oluştur
php /var/www/html/artisan storage:link

# Laravel önbellekleri temizle
php /var/www/html/artisan optimize:clear
php /var/www/html/artisan view:clear
php /var/www/html/artisan config:clear

# Laravel queue worker'ı başlat
php /var/www/html/artisan queue:work --daemon &

# Tüm servislerin bitmesini bekle
wait
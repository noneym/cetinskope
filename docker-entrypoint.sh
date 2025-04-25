#!/bin/sh
# Nginx ve PHP-FPM'i arka planda başlat
/start.sh &

# Nginx'in başlamasını bekle
sleep 5

# Dosya izinlerini ayarla
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

mkdir -p /var/www/html/storage/app/temp
chmod -R 777 /var/www/html/storage/app/temp

# Laravel queue worker'ı başlat
php /var/www/html/artisan queue:work --daemon &

# Tüm servislerin bitmesini bekle
wait

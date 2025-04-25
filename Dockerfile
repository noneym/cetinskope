FROM richarvey/nginx-php-fpm:latest

# Alpine ve PHP sürümlerini kontrol et
RUN cat /etc/alpine-release && php -v

# Gerekli paketleri yükle
RUN apk update && apk add --no-cache \
    nano \
    python3 \
    yarn \
    py3-pip \
    mysql-client \
    curl \
    php82-dev \
    autoconf \
    build-base \
    openssl-dev \
    php82-openssl \
    git \
    openssh-client \
    libc6-compat \
    krb5-dev \
    build-base \
    php82-soap \
    libxml2-dev \
    linux-headers # Excimer için gerekli

# Node.js v20'yi yüklemek için gerekli depoyu ekle ve yükle
RUN apk add --no-cache nodejs-current npm



# zend.exception_ignore_args ayarını güncelle
RUN echo "zend.exception_ignore_args = Off" >> /usr/local/etc/php/php.ini

# Uygulama kodunu kopyala
COPY . /var/www/html

# Özel Nginx konfigürasyon dosyasını kopyala
COPY nginx.conf /etc/nginx/sites-enabled/default.conf

# docker-entrypoint.sh dosyasını kopyala ve çalıştırılabilir hale getir
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Çalışma dizinini ayarla
WORKDIR /var/www/html

# Node modüllerini yükle ve Vite build komutunu çalıştır
RUN npm install && npm run build
RUN npm install -g wrangler

# Portları aç
EXPOSE 80 8080

# Giriş noktasını ayarla
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
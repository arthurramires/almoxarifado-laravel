FROM php:7.3.6-fpm-alpine3.10

RUN apk add --no-cache shadow openssl \
    bash \
    mysql-client \
    git \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev

RUN touch /root/.bashrc | echo "PS1='\w\$ '" >> /root/.bashrc
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN docker-php-ext-configure pdo_mysql
RUN touch /home/www-data/.bashrc | echo "PS1='\w\$ '" >> /home/www-data/.bashrc

ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
RUN rm -rf /var/www/html && ln -s public html
COPY . /var/www

RUN chmod -R 777 storage

EXPOSE 9000



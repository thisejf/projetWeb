FROM php:7.3

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y \
    git \
    unzip

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Paris /etc/localtime
RUN "date"
RUN echo 'alias sf="php bin/console"' >> ~/.bashrc

COPY . /app
WORKDIR /app

CMD php -S 0.0.0.0:80 /app/public/index.php
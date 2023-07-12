FROM php:7.2-apache

RUN apt update && apt install -y python3 && apt clean

COPY . /var/www/html

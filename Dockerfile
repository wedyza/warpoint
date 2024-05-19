# Используем официальный образ PHP с Apache для Laravel
FROM php:7.4-apache

# Устанавливаем расширения и утилиты
RUN docker-php-ext-install pdo_mysql mysqli

# Копируем весь проект Laravel внутрь контейнера
COPY . /var/www/html

# Устанавливаем Composer и зависимости
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
EXPOSE 8000
# CMD while true; do sleep 1000; done

ENTRYPOINT run/run.sh
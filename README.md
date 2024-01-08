# Лабораторная работа по Технологиям программирования
## Лабораторная работа №2 Вариант 9
### Постановка задачи:
Разработать простейший интернет-магазин, при помощи MVC фреймворка.
Покупателю должна быть предоставлена скидка в 10% на любой
товар в его день рождения.

### Используемые технологии
- Laravel
- PostgreSQL
- Docker

# Установка

docker-compose up nginx

docker-compose run --rm artisan storage:link

docker-compose run --rm composer require barryvdh/laravel-debugbar --dev

docker-compose run --rm composer require laravel/telescope

docker-compose run --rm artisan telescope:install

docker-compose run --rm artisan migrate

docker-compose run --rm composer require laravel/ui

docker-compose run --rm php artisan ui bootstrap --auth

cd src

npm install

npm run build

##### В случае, если в проекте нет папки src:

docker-compose run --rm composer create-project laravel/laravel .

##### В случае, если выбивает ошибку на папку логов в storage:
Заходим к контейнер nginx, выполняем команду
chmod -R 755 storage
chmod -R 755 bootstrap/cache

### Для использования composer:
docker-compose run --rm composer <Команда>
### Для использования artisan:
docker-compose run --rm artisan <Команда>
### Запуск тестов:
docker-compose run --rm artisan test

### TODO: Вынести команды в makefile, выполнять npm не локально, разобраться с правами в Windows

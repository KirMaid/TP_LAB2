#Installation

docker-compose up

docker-compose run artisan storage:link

docker-compose run composer require barryvdh/laravel-debugbar --dev

docker-compose run composer require laravel/telescope

docker-compose run artisan telescope:install

docker-compose run artisan migrate

docker-compose run composer require laravel/ui

docker-compose run php artisan ui bootstrap --auth

cd src

npm install

npm run build

#####В случае, если в проекте нет папки src:

docker-compose run composer create-project laravel/laravel .

##### В случае, если выбивает ошибку на папку логов в storage:
Заходим к контейнер nginx, выполняем команду
chmod -R 777 storage
chmod -R 777 bootstrap/cache

### Для использования composer:
docker-compose run --rm composer <Команда>
### Для использования artisan:
docker-compose run --rm artisan <Команда>
### Запуск тестов:
docker-compose run --rm artisan test

###TODO: Вынести команды в makefile, выполнять npm не локально, разобраться с правами в Windows
#Installation

docker-compose up

docker-compose run artisan storage:link

В случае, если в проекте нет папки src:

docker-compose run composer create-project laravel/laravel .

### Для использования composer:
docker-compose run composer <Команда>
### Для использования artisan:
docker-compose run artisan <Команда>
# Books Catalog (Yii1) Инфотек

## Запуск

- `make up` - поднять контейнеры (приложение доступно по http://localhost:8080, если не задан `NGINX_PORT`)
- `make migrate` - применить миграции

## Тесты

- `docker compose exec php ./vendor/bin/phpunit -c protected/tests/phpunit.xml`

## Credentials

A default user is created during migrations:

- email: `user@yii-it.tech`
- password: value of `DEFAULT_SITE_USER_PASSWORD`

## Routes

- `/` - books catalog
- `/book/index` - books list
- `/author/index` - authors list
- `/report/topAuthors` - report
- `/site/login` - login

## SMS notifications

Sending is done via `SmsPilotClient` when a new book is created. For testing, use the emulator key from `https://smspilot.ru/` (no real SMS is sent).

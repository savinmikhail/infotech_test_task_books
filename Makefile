DOCKER_COMPOSE ?= docker compose

up:
	$(DOCKER_COMPOSE) up -d
	@echo "App URL: http://localhost:$${NGINX_PORT:-8080}"

php:
	$(DOCKER_COMPOSE) exec php sh

migrate:
	$(DOCKER_COMPOSE) exec php php protected/yiic migrate --interactive=0

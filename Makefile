PACKAGE_MANAGER = dnf
MYSQL_CONTAINER = mysql-kalashnikov

.PHONY = help install install-dependencies init-db seed-db up down delete

include .env
export

help:
	@echo "make install  - Установить проект локально"
	@echo "make up       - Запустить проект"
	@echo "make down     - Остановить проект"
	@echo "make delete   - Удалить проект"

install:
	$(MAKE) install-dependencies
	$(MAKE) build

db:
	$(MAKE) init-db
	$(MAKE) seed-db

install-dependencies:
	sudo ${PACKAGE_MANAGER} install -y php docker docker-compose composer

init-db:
	docker exec -i $(MYSQL_CONTAINER) mysql -u$(DB_USERNAME) -p$(DB_PASSWORD) $(DB_DATABASE) < docker/mysql/schema.sql

seed-db:
	docker exec -i $(MYSQL_CONTAINER) mysql -u$(DB_USERNAME) -p$(DB_PASSWORD) $(DB_DATABASE) < docker/mysql/seed.sql

build:
	docker compose up --build

up:
	docker compose up 

down:
	docker compose down

delete:
	docker compose down -v

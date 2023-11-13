# =================================
# Variables                       #
# =================================
CG=\033[0;36m#..........green color
CP=\033[0;35m#...........pink color
CF=\033[0;33m#...........pink color
NC=\033[0m#................no color
SPRINT=1.0.0#...............Version
COMMANDS=${CP}Commands${NC}
DATE=`date +%Y-%m-%d-%H.%M.%S`
APP_NAME := my-laravel-app
DOCKER_COMPOSE := docker-compose
PHP_CONTAINER := app
ARTISAN := $(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan
define ANNOUNCE_BODY
TIRIVIA GAME
endef
define ANNOUNCE_MENU
========================================================================
To easily install and control this application, you can use the below commands.
${CF}For example : ${NC}make ${CP}up${NC}
------------------------------------------------------------------------
 | ${COMMANDS}         | Description
------------------------------------------------------------------------
 | up               | Start the services
 | down             | Shutdown the services
 | restart          | Restart the Docker containers
 | shell            | Open a shell inside the PHP container
 | composer-install | Run composer install
 | clean            | Remove all generated files and containers
========================================================================
endef
export ANNOUNCE_BODY
export ANNOUNCE_MENU

#==================================
# Start Program                   #
#==================================
help:
	@echo "${CG}"
	@echo "$$ANNOUNCE_BODY"
	@echo "${NC}"
	@echo ""
	@echo "$$ANNOUNCE_MENU"

#==================================
# Command                         #
#==================================
start:
	$(DOCKER_COMPOSE) build
	$(DOCKER_COMPOSE) up -d
	$(ARTISAN) migrate
	$(ARTISAN) db:seed

play:
	$(ARTISAN) trivia:play

build:
	$(DOCKER_COMPOSE) build -no-cache

up:
	$(DOCKER_COMPOSE) up -d --remove-orphans

down:
	$(DOCKER_COMPOSE) down

seed:
	$(ARTISAN) db:seed

rollback:
	$(ARTISAN) migrate:rollback
	$(ARTISAN) migrate

restart:
	$(DOCKER_COMPOSE) restart

shell:
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) sh

composer-install:
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) composer install

clean: down
	rm -rf vendor
	rm -rf node_modules
	rm -rf storage/framework/*
	rm -rf bootstrap/cache/*
	rm -rf .phpunit.result.cache

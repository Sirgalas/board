include .env
init: down-volume build up

up: memory # create and start containers
	@docker-compose -f ${DOCKER_CONFIG} up -d

down: # stop and destroy containers
	@docker-compose -f ${DOCKER_CONFIG} down

down-volume: #  WARNING: stop and destroy containers with volumes
	@docker-compose -f ${DOCKER_CONFIG} down -v

start: # start already created containers
	@docker-compose -f ${DOCKER_CONFIG} start

stop: # stop containers, but not destroy
	@docker-compose -f ${DOCKER_CONFIG} stop

ps: # show started containers and their status
	@docker-compose -f ${DOCKER_CONFIG} ps

build:# build all dockerfile, if not built yet
	@docker-compose -f ${DOCKER_CONFIG} build

memory:
	sudo sysctl -w vm.max_map_count=262144

connect_app: # php-fpm command line
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm sh

connect_node: # node command line
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app node sh

connect_redis: # node command line
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app redis sh

connect_nginx: # nginx command line
	@docker-compose -f ${DOCKER_CONFIG} exec -w /www nginx sh

connect_db: # database command line
	@docker-compose -f ${DOCKER_CONFIG} exec db bash

connect_test_db: # database command line
	@docker-compose -f ${DOCKER_CONFIG} exec test-db bash

init: # laravel install
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm composer create-project --prefer-dist laravel/laravel .

vendor: # composer install
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm composer install

migrate: # composer install
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm php artisan migrate

key: # gen application key
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm php artisan key:generate

fresh: # refresh the database and run all database seeds
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm php artisan migrate:fresh --seed

composer_dump: # composer dump-autoload
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm composer dump-autoload

composer_update: # composer dump-autoload
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm composer update

test: # run all tests
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm php vendor/bin/phpunit

create_controller: # create controller name=[controllerName]
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm php artisan make:controller $(name)Controller

create_crud: # create controller name=[controllerName]
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm php artisan make:controller $(name)Controller --resource

create_model: # create model name=[modelName]
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm php artisan make:model Entity/$(name) -m

create_seeder: # create migration name=[seederName]
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm php artisan make:seeder $(name)TableSeeder

create_migration: # create seeder name=[seederName]
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm php artisan make:migration $(name)

create_test: # create test name=[testName]
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm php artisan make:test $(name)Test

create_unit_test: # create test unit name=[seederName]
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm php artisan make:test $(name)Test --unit

create_request: # create request name=[seederName]
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm php artisan make:request $(name)Request

create_command: # create command name=[seederName]
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm php artisan make:command $(name)Command

api_doc: # create command name=[seederName]
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm php artisan api:doc

ide_helpers: # create ide helpers
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm php artisan ide-helper:$(name)

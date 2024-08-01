shell:
	docker-compose exec app bash

build:
	docker-compose build
up:
	docker-compose up -d

install:
	docker-compose exec app bash -c 'composer install --no-interaction'
update:
	docker-compose exec app bash -c 'composer update --no-interaction'

run: build up install
run-update: build up update

down:
	docker-compose down
stop:
	docker-compose stop

tests:
	docker-compose exec app bash -c './vendor/bin/phpunit'

up:
	docker-compose up -d
	docker-compose exec app composer install

phpunit:
	docker-compose exec app vendor/bin/phpunit

stop:
	docker-compose down

install:
	composer install

test:
	vendor/bin/psalm --no-cache
	vendor/bin/phpunit

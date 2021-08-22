test: phpstan phpunit

phpstan: vendor/bin/phpstan
	php vendor/bin/phpstan analyze src/ --level=max

vendor/bin/phpstan:
	composer install

phpunit: vendor/bin/phpunit
	php vendor/bin/phpunit

vendor/bin/phpunit:
	composer install


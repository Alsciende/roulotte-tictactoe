test: phpstan schema phpunit

phpstan: vendor/bin/phpstan
	php vendor/bin/phpstan analyze src/ --level=max

vendor/bin/phpstan:
	composer install

schema:
	bin/console doctrine:schema:validate

phpunit: vendor/bin/phpunit
	php vendor/bin/phpunit

vendor/bin/phpunit:
	composer install

clean:
	bin/console d:s:d --force
	bin/console d:s:c

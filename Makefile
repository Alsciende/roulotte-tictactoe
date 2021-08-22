test: phpstan

phpstan: vendor/bin/phpstan
	php vendor/bin/phpstan analyze src/ --level=max

vendor/bin/phpstan:
	composer install

install:
	composer install
	
test:
	composer exec phpunit tests

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

test-coverage-html:
	composer exec --verbose phpunit tests --  --coverage-html build/logs/html-coverage
	
lint:
	composer exec phpcs -- --standard=PSR12 src tests
serve:
	php -S 127.0.0.1:8001 -t public

cc:
	php bin/console cache:clear

db-create:
	php bin/console doctrine:database:create

db-drop:
	php bin/console doctrine:database:drop --force

db-wipe:
	php bin/console doctrine:schema:drop --force

db-migrate:
	php bin/console doctrine:migrations:migrate -n

db-init: db-wipe db-migrate

db-seed:
	php bin/console doctrine:fixtures:load --no-interaction

testu:
	bin/phpunit -c phpunit_unit.xml

testf:
	bin/phpunit -c phpunit_functional.xml

test: testu testf

coverage:
	bin/phpunit -c phpunit_unit.xml --coverage-html public/coverage

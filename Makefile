cc:
	bin/console cache:clear

serve:
	php -S 127.0.0.1:8001 -t public

db-create:
	bin/console doctrine:database:create

db-drop:
	bin/console doctrine:database:drop --force

db-wipe:
	bin/console doctrine:schema:drop --force

db-schema: db-wipe
	bin/console doctrine:schema:create

db-migrate:
	bin/console doctrine:migrations:migrate -n

db-init: db-drop db-create db-migrate

db-seed:
	bin/console doctrine:fixtures:load --no-interaction

testu:
	bin/phpunit -c phpunit_unit.xml

testf:
	bin/phpunit -c phpunit_functional.xml

test: testu testf

coverage:
	bin/phpunit -c phpunit_unit.xml --coverage-html public/coverage

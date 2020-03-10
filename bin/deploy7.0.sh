#!/bin/sh

/usr/bin/php7.0 /usr/bin/composer install
/usr/bin/php7.0 bin/console doctrine:database:create
/usr/bin/php7.0 bin/console doctrine:schema:update --force --no-interaction
/usr/bin/php7.0 bin/console doctrine:fixtures:load --no-interaction

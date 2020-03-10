#!/bin/sh

composer install
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force --no-interaction
php bin/console doctrine:fixtures:load --no-interaction

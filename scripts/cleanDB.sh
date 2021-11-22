#!/bin/sh -x

docker-compose exec  mariadb mysql --force -pwelcome1 love_you_a_latte < ./docker/mariadb/clean/databaseClean.sql


# Symfony Kafka docker compose

A simple aproach on how to stream events from a symfony producer to a symfony consumer following DDD and event streaming patterns

## How to start

from root directory lift the images
docker-compose -f docker-compose.yml  up -d --build --force-recreate --remove-orphans

enter on php_api container and run migrations
docker exec -it php_api bash
bin/console d:m:m

enter on php_core and run migrations
docker exec -it php_core bash
bin/console d:m:m

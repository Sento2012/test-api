#!/usr/bin/make
SHELL = /bin/bash

install:
	docker-compose build --no-cache
	docker-compose up -d
	sleep 30
	docker exec -i db-api mysql -uroot -proot root < src/city.sql

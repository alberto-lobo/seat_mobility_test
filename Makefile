-include .env
export

# Colours
BLUE:=			\033[0;34m
RED:=			\033[0;31m
LIGHT_RED:=		\033[1;31m
WHITE:=			\033[1;37m
LIGHT_VIOLET := \033[1;35m
NO_COLOUR := 	\033[0m


PROJECT_NAME := seat_mobility_test

MSG_SEPARATOR := "*********************************************************************"
MSG_IDENT := "    "


.SILENT:

help:
	echo "\n${MSG_SEPARATOR}\n$(LIGHT_VIOLET)$(PROJECT_NAME)$(NO_COLOUR)\n${MSG_SEPARATOR}\n"
	echo "${MSG_IDENT}=======   ✨  BASIC   =====================================\n   "
	echo "${MSG_IDENT}  ⚠️   Requirements : Docker & PHP \n"
	echo "${MSG_IDENT}  install                 -  📦 Install the project"
	echo "${MSG_IDENT}  tests                   -  ✅ Run all tests"

install: build composer

composer:
	@docker exec --tty $(PROJECT_NAME)-php-fpm composer install --no-interaction
build:
	@docker-compose up -d --build --force-recreate --remove-orphans

tests:
	@docker exec --tty -e $(PROJECT_NAME)-php-fpm php ./bin/phpunit
docker_php = startuplaravel_fpm_1
docker_nginx = startuplaravel_nginx_1
docker_mysql = startuplaravel_mysql_1

#some commands
start: #Containers start
	@docker-compose up -d

stop: #Stop
	@docker-compose down

show_containers:
	@docker ps

connect_php:
	@docker exec -it $(docker_php) bash

connect_nginx:
	@docker exec -it $(docker_nginx) bash

connect_mysql:
	@docker exec -it $(docker_mysqln) bash
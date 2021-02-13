# LIG PH Technical Exam
The sole purpose of this repository is for the LIG Philippines technical examination of Jericho M. Gimoros.

## Specifications / Infrastructure Information
- Nginx
- PHP-FPM
- MySQL
- Postfix
- CS-Fixer
- Composer
- Cron
- Node/NPM
- Redis

## Prerequisites
- git
- docker
- docker-compose

## Getting Started
Copy `.env` for docker in root directory
```
cp .env.example .env
```
Fill in variables
```
ENVIRONMENT=development
PROJECT_NAME=ligph
MYSQL_ROOT_PASSWORD=username
MYSQL_DATABASE=ligph
MYSQL_USER=username
MYSQL_PASSWORD=username
MAIL_NAME=
MAIL_HOST=
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
DOCKER_IP=172.0.0.0
TIMEZONE=Asia/Tokyo
API_DOMAIN=api.app.local
APP_DOMAIN=app.local
```
Add the following lines to host file
```
192.168.99.100    app.local api.app.local
```
Note: Replace `192.168.99.100` with your docker machine IP.

## Build the all containers
```
docker-compose build
```
Start the containers
```
docker-compose up -d
```
Run the following command to login to any docker container
```
docker exec -it CONTAINER_NAME bash
```
## Setting up Laravel
Install the composer packages
```
docker-compose run composer install
```
Create the `.env` file and run the following to generate key for Laravel
```
docker-compose run php cp .env.example .env
docker-compose run php php artisan key:generate
```
Update the `.env` values especially the **database credentials** then refresh the config
```
docker-compose run php php artisan config:clear
```
Run the migration with seeders
```
docker-compose run php php artisan migrate:fresh --seed
```

## Fix issues on laravel write permissions
Login to php container
```
 docker-compose exec php bash
```
Add full permissions to the storage directory
```
chmod 777 -R storage/
```

## PSR2 Coding Style
Running the coding standards fixer container

To check without applying any fixes, run the following command:
```
docker-compose run fixer fix --dry-run -v
```
To fix all your PHP code to adhere the PSR2 Coding style, run:
```
docker-compose run fixer fix
```
To apply fix only to a specific file
```
docker-compose run fixer fix <<file_name>>
```

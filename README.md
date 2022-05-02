# PREVENTOOL

## What is this?
PHP application using ***Domain-Driven Design (DDD) and Command Query Responsibility Segregation (CQRS)*** principles.\
Implemented with Symfony 5.4 and includes `Docker configuration`.

- Authentication system with Json Web Tokens (JWT) (https://github.com/lexik/LexikJWTAuthenticationBundle)
- It contains Open API v3 documentation
![Endpoints](./doc/endpoints.png)
- Storage in DigitalOcean Spaces that are compatible with the AWS S3
- Asynchronous event integration with RabbitMQ
- Unit tests
- Integration tests
- Functional tests to cover the user endpoints use cases

## Usage /app
- `make copy-files` to creates a copy of .env and docker-compose.yml.dist file to use locally
- `make build` to build the docker environment
- `make run` to spin up containers
- `make restart` to stop and start containers
- `make prepare` to install composer dependencies
- `make generate-ssh-keys` to generate JWT certificates
- `make migrate-database` to runs the migrations
- `make migrate-database-tests` to runs the database-tests migrations
- `make create-root-user` after installing create the first user with root role
- `make all-tests` to run the test suite
- `make ssh-be` to access the PHP container bash
- `make supervisor` Run supervisor with defined config in docker/php/supervisord.conf

## Usage /doc
- `make build` to build the docker environment
- `make run` to spin up containers
- Navigate to `http://localhost:2500/index.html` to check the Open API v3 documentation and testing endpoints
- `make restart` to stop and start containers

## Stack:
- `NGINX 1.19` container
- `PHP 8.0.6 FPM` container
- `MariaDB 10.7.1` container + `volume`
- `rabbitmq:3-management-alpine` container

## Contributing
Feel free to clone, fork or PR this repo


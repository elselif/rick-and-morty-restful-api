# Rick and Morty Character API

This project provides an API to fetch, store, and serve character data from the Rick and Morty series.



- **Laravel**: The PHP framework used to build the API.
- **MySQL**: The database management system used to store character, episode, and location data.
- **Docker**: Used to containerize the application environment.
- **Laravel Sail**: A lightweight command-line interface for interacting with Laravel's Docker development environment.
- **Postman**: A collaboration platform for API development. A Postman collection is included in the `docs` directory to demonstrate API endpoints and usage.
- **PHPUnit**: The unit testing framework for PHP. Unit tests are included in the `tests` directory to ensure the reliability of the application.

## Installation

1. Clone this repository:

```bash
git clone https://github.com/user/repository.git

```
2. Copy the .env.example file to .env:

```bash
cp .env.example .env
```
3. Configure the .env file according to your environment.

4. Run Sail's installation command:
```bash
./vendor/bin/sail up -d
```

5. Create the database and migrate tables:
```bash
./vendor/bin/sail artisan migrate
```

6. To fetch data from the Rick and Morty API and store it in the database, run the following command:
```bash
./vendor/bin/sail artisan rickandmorty:getdata
```

## Usage

You can access the data by making HTTP requests to the API. For example:

Send a GET request to list all characters:

```bash
GET http://localhost/api/characters
```
Send a GET request to view a specific character:
```bash
GET http://localhost/api/characters/{id}
```
Send a POST request to create a new character:
```bash
POST http://localhost/api/characters
```
Send a PUT request to update a character:
```bash
PUT http://localhost/api/characters/{id}
```
Send a DELETE request to delete a character:
```bash
DELETE http://localhost/api/characters/{id}
```

## Postman Collection
A Postman collection is available in the docs directory. Import this collection into Postman to explore and interact with the API endpoints.

## Unit Tests

Unit tests are included in the tests directory. You can run the tests using PHPUnit to ensure the reliability of the application.


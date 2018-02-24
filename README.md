# LetMeHack

Request/Response Format
All requests and responses must be in JSON, with the Content-Type header set to application/json.

Error Handling

For API to be consistent, always return error responses in json. JSON schema of the errors returned should be like the following:
```
{
"status": 401,
"message": "Invalid username or password.",
"developerMessage": "Login attempt failed because the specified password is incorrect."
}
```

# LetMehack Starter with Dialog Ideamart

# Requirements 

- Install ConEmu(Please use this terminal on Windows to avoid errors with docker-compose)
- Install PHP 7.2.2 from XAMMP and install composer
- Install NodeJS on your machine
- Install docker and docker-compose

# Run locally

- Clone this repo(or your fork)
- Open terminal there
- ``cp .env.example .env``
- Set .env values to your database configurations
- Run ``composer install``
- Run ``php artisan:key generate``
- Run ``php artisan migrate:fresh``
- Finally start development server by ``php artisan serve``

    ## If you are on a linux
     - Run ``sudo chmod -R 777 storage/*`` before serve

# Run with Docker

- Clone this repo(or your fork)
- Open terminal there
- ``cp .env.example .env``
- Run ``composer install``
- Run ``php artisan:key generate``
- Run ``docker-compose up`` to spin up the docker instances (First time will be slow)
- Run ``docker ps`` and check the name for **letmehack_app_1**
- Run ``docker exec -it letmehack_app_1 /bin/sh`` to log into docker's bash
- Then on it run ``php artisan migrate:fresh``
- Type ``exit`` to exit bash of docker container
- Then go to 127.0.0.1:8081 for see your app running
- If ask for drive share permission? allow it
- For shutdown the docker machine run ``docker-compose down`` on the directory



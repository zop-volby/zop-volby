# zop-volby

## Getting started

1. Install node (and npm), php (and composer)

1. Install dependencies

    ```bash
    composer update
    npm update
    ```

1. Setup database

    First copy .env.example to .env and fill in the database credentials.

    > Alternative to working with SQLite: change DB_CONNECTION to `sqlite` in .env and delete remaining DB_* variables.

    Finally initiate database with following command:

    ```bash
    php artisan migrate
    ```

1. Generate application key

    ```bash
    php artisan key:generate
    ```

1. Run server

    ```bash
    .\start.cmd
    ```
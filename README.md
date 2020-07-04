# Recommendation System

## Tested environment

- Laravel 7.0
- php 7.3
- MySQL 5.7

## Installation

```bash
$ git clone https://github.com/basemkhirat/recommendation-system
$ cd recommendation-system
$ composer install
```

## Configuration

1. Rename the file `.env.example` to `.env`.
2. Generate application key using the artisan command:

    ```bash
    $ php artisan key:generate
    ```

3. Change database configurations in `.env` based on your environment.
4. Set the directories `storage` and `bootstrap/cache` to be writable.
5. Run database migrations and seeds scripts:

    ```bash
    $ php artisan migrate
    $ php artisan db:seed
    ```
6. Start the development server.
    ```bash
    $ php artisan serve
    ```


## Testing

```bash
$ php artisan test
```

## Author
[Basem Khirat](http://basemkhirat.com) - [basemkhirat@gmail.com](mailto:basemkhirat@gmail.com)

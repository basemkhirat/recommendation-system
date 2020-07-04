# Recommendation System

## Tested environment

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
2. Change configurations in `.env` based on your environment.
3. Run database migrations and seeds scripts

```bash
$ php artisan migrate
$ php artisan db:seed
```

## Testing

```bash
$ php artisan test
```

## Author
[Basem Khirat](http://basemkhirat.com) - [basemkhirat@gmail.com](mailto:basemkhirat@gmail.com)

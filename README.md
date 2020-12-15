# Backend Role heroes

Backend implementation for role heroes app

## Requirments

- PostgreSQL v13.0
- PHP v7.4.11

## Deploying project

1. Run to terminal `cp .env.example .env`
2. Edit `.env` file
    - Edit `DB_*` options
3. Generate app key `php artisan key:generate`
4. Run migrations `php artisan migrate`
5. Run local server `php artisan serve`

## Authors project

[Vasiliy Nikifrovo](https://github.com/kaktusv6)

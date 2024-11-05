# Recipe Search Demo

This is a small demo application built with Laravel on the backend and Nuxt/Vue on the frontend.
With it, you can view and search for recipes by author email, ingredient, and keywords.

# Running Locally

Get started with:
```bash
docker run --rm --pull=always -v "$(pwd)":/opt -w /opt laravelsail/php82-composer:latest bash -c "composer install"

# Bring sail up
./vendor/bin/sail up -d

# Get Laravel Running
cp .env.example .env
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed LordOfTheRingsRecipeSeeder
# You can also generate dummy data with the regular seeder
# ./vendor/bin/sail artisan db:seed

# Get Nuxt Running
./vendor/bin/sail npm install --prefix frontend
./vendor/bin/sail npm run dev --prefix frontend
````

You should now be able to access the app at http://localhost:3000

# Developing locally

After cloning, get githooks set up with `./githooks/setup-git-hooks.sh`. This runs phpunit, phpstan, and pint on
commit to keep things tidy.

Here are some helpful commands:

```
# Refresh the database
./vendor/bin/sail php artisan migrate:fresh

# Seed using the LOTR recipe seeder for fun!
./vendor/bin/sail artisan db:seed LordOfTheRingsRecipeSeeder

# You can also generate dummy data with the regular seeder
# ./vendor/bin/sail artisan db:seed

# Format code with pint
./vendor/bin/sail pint

# Generate IDE helper. See https://github.com/barryvdh/laravel-ide-helper
./vendor/bin/sail php artisan ide-helper:generate

# Generate model annotations. See https://github.com/barryvdh/laravel-ide-helper
./vendor/bin/sail php artisan ide-helper:models

# Run Tests
./vendor/bin/sail php artisan test
```


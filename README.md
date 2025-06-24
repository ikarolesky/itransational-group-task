
# Laravel CSV StockImporter

Product importer via CSV with business rules:
- Filter prices (< R$5+stock<10 or >R$1000)
- Discontinued brands with current date
- CLI command with `--test` mode
- Reports and unit tests

## Use
Install dependencies:

```composer install```

Run migrations:

```php artisan migrate```

Import CSV:

- Simulated

```php artisan stock:import {path/to/file} --test```

- Production 
```php artisan stock:import {path/to/file}```

Run tests:

```php artisan test```

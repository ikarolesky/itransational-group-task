How to install
Clone the repo
Run ```composer install```
Run migrations
```php artisan migrate```

🧰 How to run it
Normally
```php artisan stock:import storage/app/products.csv```
Test Mode
```php artisan stock:import storage/app/products.csv --test```

✅ Unit Testing
```php artisan test```
OR
``` php artisan test --filter=ImportStockCommandTest```

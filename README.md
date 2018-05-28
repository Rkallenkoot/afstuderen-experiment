# Experimenting performance of translatable model packages in combination with multiple API implementations

- Using query parameters to select the current locale
- Using the user context to select the current locale

## MVP A
Using laravel-translatable by spatie
https://github.com/spatie/laravel-translatable

## MVP B
Using laravel-translatable by dimsav
https://github.com/dimsav/laravel-translatable


## Database benchmarks
https://github.com/akopytov/sysbench

https://tools.ietf.org/html/rfc7231#section-3.1.3.2


`sysbench --db-driver=mysql --mysql-db=db --mysql-user=root --mysql-host=127.0.0.1 --mysql-port=3306 --mysql-password=pass --test=test.lua --threads=8 --time=60 run > results.txt`

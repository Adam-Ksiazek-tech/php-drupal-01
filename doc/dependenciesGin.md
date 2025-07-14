# moduły gin, devel

### Wejdź do kontenera

```
docker exec -it php-drupal_web bash
```

sprawdź, czy jest composer

```
root@48929d1805af:/var/www/html# composer --version
Composer version 2.8.10 2025-07-10 19:08:33
PHP version 8.1.33 (/usr/local/bin/php)
```
instalacja nowych zależności

```
composer require drupal/gin drupal/devel
```
przykład

`root@48929d1805af:/var/www/html# composer require drupal/gin drupal/devel`


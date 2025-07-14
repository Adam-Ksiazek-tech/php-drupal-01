# moduły gin, devel

## Wejdź do kontenera

```
docker exec -it php-drupal_web bash
```

sprawdź, czy jest composer

```
root@48929d1805af:/var/www/html# composer --version
Composer version 2.8.10 2025-07-10 19:08:33
PHP version 8.1.33 (/usr/local/bin/php)
```

### instalacja nowych zależności

### drush

```
composer require --dev drush/drush
```

#### Gin (Drupal admin theme)

Lepszy UX/UI: bardziej nowoczesny wygląd, zgodny z trendami projektowania.

Responsywność: dobrze działa na urządzeniach mobilnych.

Usprawniona nawigacja: pasek boczny, przejrzyste przyciski, łatwa konfiguracja.

Integracja z Layout Builderem: poprawia wygląd narzędzia do tworzenia layoutów.

#### Devel (Development module)

Kint: eleganckie wyświetlanie struktur danych (np. obiektów, tablic).

Generowanie zawartości: szybkie tworzenie fikcyjnych użytkowników, węzłów, taksonomii itp.

Przegląd Hooków: wyświetlanie dostępnych hooków i ich implementacji.

Debugowanie wydajności: pomiar czasu wykonywania, użycia pamięci.

Reset cache: szybkie czyszczenie pamięci podręcznej.

#### Jak dodać zależności via composer
```
composer require drupal/gin drupal/devel
```
#### przykład

`root@48929d1805af:/var/www/html# composer require drupal/gin drupal/devel`

po zainstalowaniu gin i devel:

```
drush updb
drush cr
```
#### włączenie
- Włącz moduł GIN

`drush en devel -y`

- Włącz motyw gin

`drush theme:enable gin -y`

###

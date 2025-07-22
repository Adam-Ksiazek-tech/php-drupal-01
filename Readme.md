# Drupal 9

## Struktura projektu
```
📁 drupal-docker-9/
├── 📁 apache/
│   └── 📄 drupal.conf           ← tutaj umieszczasz plik konfiguracyjny Apache
├── 📄 docker-compose.yml        ← główny plik docker-compose
├── 📄 Dockerfile                ← konfiguracja kontenera web (PHP + Apache)
├── 📁 drupal/              ← katalog z kodem Drupala (utworzony przez Composer)│   
│   ├── 📄 composer.json
│   └── 📁 web/
│       ├── 📄 index.php
│       └── 📁 sites/
│           └── 📁 default/
│               └── 📁 files/
├── 📄 .env
├── 📁 scripts/             ← TU DODAJEMY SKRYPT DLA INSTALACJI OD ZERA
│   └── 📄 init-drupal.sh  
└── ...
```
## Postawienie projektu od zera 

na start, potrzebne są pliki:
docker-compose.yml
Dockerfile
apache/drupal.conf


- Tymczasowy kontener z Composerem (polecana, bez zmian w Dockerfile)

```
docker run --rm -v "$PWD:/app" -w /app composer:2 composer create-project --ignore-platform-req=ext-gd drupal/recommended-project:^9 drupal
```

#### Uruchomienie kontenerów

```
docker-compose up --build
```

#### Jeśli uruchominie jest od zera dla Drupala

```
bash scripts/init-drupal.sh
```

#### Kasowanie poprzedniego wolumenu db

```
docker volume rm <nazwa_wolumenu>
```

#### Lokalna baza danych

Nazwa bazy danych	    drupal
Nazwa użytkownika	    drupal
Hasło	                drupal
Serwer bazy danych	    db (nazwa usługi z docker-compose.yml)
Port (opcjonalnie)	zostaw puste (albo 3306, jeśli wymagane)

#### zebezpiecznia plików 

Uruchamiane z hosta

##### Zabezpiecz plik - settings.php:

```
docker exec -it php-drupal_web bash -c "chmod 444 /var/www/html/web/sites/default/settings.php"
```

##### Zabezpiecz plik - services.yml:

```
docker exec -it php-drupal_web bash -c "chmod 644 /var/www/html/web/sites/default/services.yml"
```

### Wejście do dockera

docker exec -it php-drupal_web bash

## Dodanie drush

dodanie drush przez composer dla via chwilowy docker
- na hoście wchodzimy
```
cd drupal
```
- Zainstaluj drush przez composer (na hoście, ale w folderze drupal)
```
docker run --rm -v "$PWD:/app" -w /app composer:2 composer config platform.php 8.1.0
docker run --rm -v "$PWD:/app" -w /app composer require drush/drush --dev --ignore-platform-req=ext-gd
```

## Instalacja nowych zależności

[instalacja zależności](docs/dependenciesGin.md)

##
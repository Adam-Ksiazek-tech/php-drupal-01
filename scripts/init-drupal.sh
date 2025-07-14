#!/bin/bash

CONTAINER_NAME="php-drupal_web"
WEBROOT="/var/www/html/web"
FILES_DIR="$WEBROOT/sites/default/files"
TRANSLATION_DIR="$FILES_DIR/translations"
SETTINGS_SRC="$WEBROOT/sites/default/default.settings.php"
SETTINGS_DEST="$WEBROOT/sites/default/settings.php"
SERVICES_FILE="$WEBROOT/sites/default/services.yml"

echo "🔍 Sprawdzanie katalogu translations..."
docker exec -it $CONTAINER_NAME bash -c "[ -d '$TRANSLATION_DIR' ]"
if [ $? -ne 0 ]; then
  echo "📁 Tworzę katalog $TRANSLATION_DIR"
  docker exec -it $CONTAINER_NAME bash -c "
    mkdir -p $TRANSLATION_DIR
  "
fi

echo "📄 Sprawdzanie pliku settings.php..."
docker exec -it $CONTAINER_NAME bash -c "[ -f '$SETTINGS_DEST' ]"
if [ $? -ne 0 ]; then
  echo "📄 Kopiuję default.settings.php → settings.php"
  docker exec -it $CONTAINER_NAME bash -c "
    cp $SETTINGS_SRC $SETTINGS_DEST
  "
fi

echo "📄 Sprawdzanie pliku services.yml..."
docker exec -it $CONTAINER_NAME bash -c "[ -f '$SERVICES_FILE' ]"
if [ $? -ne 0 ]; then
  echo "📄 Tworzę pusty plik services.yml"
  docker exec -it $CONTAINER_NAME bash -c "
    touch $SERVICES_FILE
  "
fi

echo "🔐 Ustawiam prawa do katalogu files/"
docker exec -it $CONTAINER_NAME bash -c "
  chown -R www-data:www-data $FILES_DIR && \
  chmod -R 775 $FILES_DIR
"

echo "🔐 Ustawiam prawa do settings.php i services.yml..."
docker exec -it $CONTAINER_NAME bash -c "
  chmod 664 $SETTINGS_DEST && \
  chmod 664 $SERVICES_FILE && \
  chown www-data:www-data $SETTINGS_DEST $SERVICES_FILE
"

echo "✅ Skrypt zakończony powodzeniem."

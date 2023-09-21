# convertor

Написано на Laravel

имеется два эндпоинта:
1)Генерация xml файла с фейковыми данными по организациям
Метод Get
Входной параметр:  int qty
В качестве параметра передается количество записей (qty), которых нужно сгенерировать в xml файле
Пример вызова:

http://voshod001.local/api/organizations?qty=10

Возвращает ссылку на скачивание xml файла

2)Преобразования переданного в качестве параметра xml файла в json.
Метод Post
Входной параметр:

xml -  файл с данными в формате xml

пример вызова:

http://voshod001.local/api/convert-xml-to-json

Запуск:

docker compose up --build -d
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan config:cache

В корне каталога файл с коллекциями:

convertor.postman_collection.json

так же можно запускать создание xml и json при помощи artisan комманд

docker compose exec app php artisan app:convert-xml-to-json-command
docker compose exec app php artisan app:create-xml-file-command

В корне лежит коллекция для запуска api через Postman

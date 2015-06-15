Установка.

1. Распакуйте архив в корень сайта.
2. Создайте таблицы в базе данных. Дамп таблиц находится в каталоге sql.
3. Настройте подключение к базе данных в файлах: protected/config/main.php и protected/config/console.php
4. Установите запись в cron. 
# crontab -e
*/1 * * * * php /puth/to/webroot/protected/yiic.php parsersite

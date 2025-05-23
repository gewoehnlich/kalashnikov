# Калашников: тестовое задание

## Технологический стек
* PHP 8.4.6
* Nginx
* MySQL 9.3
* Docker
* Composer

## Установка (Linux)
Если вы используете Fedora или CentOS - ничего дополнительно конфигурировать не нужно.
Если же вы используете какой-то другой дистрибутив, то необходимо поменять свой PACKAGE_MANAGER на необходимый в самом верху Makefile

Запускаем две команды:
```
make install
make db
```

**make install** не установит MySQL, потому что в отличии от других завимостей в проекте - у нее всегда разные названия в пакетных менеджерах. 
MySQL придется установить отдельно. 
Например, вот как это сделать на Fedora: https://docs.fedoraproject.org/en-US/quick-docs/installing-mysql-mariadb/#_install_from_fedora_main_repo

**make db** нужно запустить через какое-то время после **make install**, чтобы MySQL база данных успела до конца инициализироваться

## Использование
Проект будет доступен по адресу:
http://127.0.0.1:8000/

Можно отправлять GET запросы через Postman или писать напрямую в адресную строку:
http://127.0.0.1:8000/?word=слово&length=5&accentPosition=3

**Исчисление ударения (accentPosition) начинается с 1, а не 0**

Полезные команды Makefile можно увидеть через команду:
```
make help
```

## Удаление
Запускаем команду:
```
make delete
```


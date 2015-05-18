# Что это?

Простенькое приложение, которое позволит моим студентам поисполнять запросы.

# Схема

Лежит [здесь](docs/guide/01-schema.md)

# Тесты

```
cd application
composer install
bin/codecept build
bin/codecept run
allure -o tests/Output/Allure/Report -v 1.4.5 -- tests/Output/Allure/Data
```
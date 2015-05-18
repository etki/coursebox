# Схема запросов

| URI             | Метод  | Параметры                     | Описание                |
|-----------------|--------|-------------------------------|-------------------------|
| /               | GET    |                               | Короткая документация   |
| /user           | GET    |                               | Список пользователей    |
| /user           | POST   | login, password               | Создание пользователя   |
| /user/:id       | GET    | login, password               | Конкретный пользователь |
| /user/:id       | PUT    | login, password, new-password | Обновление пользователя |
| /user/:id       | DELETE | login, password               | Удаление пользователя   |
| /auth           | GET    |                               | Наличие авторизации     |
| /auth           | POST   | login, password               | Авторизация             |
| /auth           | DELETE |                               | Логаут                  |
| /post           | GET    |                               | Список постов           |
| /post           | POST   | title, content                | Создание поста          |
| /post/:id       | GET    |                               | Конкретный пост         |
| /post/:id       | PUT    |                               | Обновление поста        |
| /post/:id       | DELETE |                               | Удаление поста          |
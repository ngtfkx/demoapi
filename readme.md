## Demo API

Лучшие практики при разработке API на Laravel

## Структура данных

### Товар

- Наименование
- Описание
- Цена
- Фото
- Описание фото(обязательно при наличии фото)

### Категория

- Наименование
- Описание

### Тег

- Наименование

### Пользователь

- Логин
- E-mail
- Пароль

## Связи

Пользователь может иметь несколько товаров. 
Товар может иметь одну категорию и несколько тегов. 
Категория может содержать вложенные категории.

## Действия

- Аутентификация должна происходить как по логину, так и по электронной почте
- CRUD для всех сущностей
    - Методы создания\удаления\редактирования - содержат авторизацию
    - Нельзя удалять\редактировать чужие товары
    - Категории и теги можно удалять только свои при условии, что у них нет товаров
- Пагинация товаров
- Фильтрация товаров
- Поиск по товарам
- Поиск по тегам

## Дополнительно

- Кеширование
- Аутентификация через два ключа
- JSON API
- RESTfull API
- Кастомизаця ошибок в формате JSON
- Полное покрытие тестами
- Версионирование

## Прочее

- Документация
- Web-based форма для тестирования (аля ВК)
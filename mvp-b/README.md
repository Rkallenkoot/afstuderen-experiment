# MVP-A
MVP using laravel-translatable by dimsav

https://github.com/dimsav/laravel-translatable


### Entities
Entities that are used to simulate the environment of the real application

#### User

| field | type |
| ------------- | ------------- |
| id   | increments |
| name | varchar |
| email | varchar |
| preferred_language | varchar(2) |


#### Publisher

| field | type |
| ------------- | ------------- |
| id   | increments |
| name | varchar |

#### Book

| field | type |
| ------------- | ------------- |
| id   | increments |
| publisher_id | foreignkey, integer |
| title | varchar |
| isbn | varchar(13) |
| eISBN | varchar(13) |
| description | text |

#### BookTranslation

| field | type |
| ------------- | ------------- |
| id   | increments |
| book_id | foreignkey, integer |
| title | varchar |
| description | text |
| locale | varchar |
| unique_book_id_locale_index | index |


#### Category

| field     | type                |
| --------- | --------------------|
| id        | increments          |
| parent_id | foreignkey, integer |
| image_url | varchar             |


#### CategoryTranslation

| field       | type                |
| ----------- | --------------------|
| id          | increments          |
| name        | varchar             |
| locale      | varchar             |
| category_id | foreignkey, integer |
| unique_category_id_locale_index | index |


### REST API Specification

| Category                    | Book                         | Publisher                 |
|-----------------------------|------------------------------|---------------------------|
| /api/category               | /api/book                    | /api/publisher            |
| /api/category/{id}          | /api/book/{id}               | /api/publisher/{id}       |
| /api/category/{id}/books    | /api/book/{id}/categories    |                           |
| /api/category/{id}/children |                              |                           |

#### API responses per language
Querying the language for each translatable entity is possible in the following ways

- Query parameters (Query (3.4) https://tools.ietf.org/html/rfc3986 (March 23rd 2018))
- User Context (user preferences)


#### TODO

- [x] Book model tests
- [x] Publisher model tests
- [x] Category model tests

- [x] Category migration
- [x] Publisher migration
- [x] Book migration

- [x] User factory
- [x] Category factory
- [x] Publisher factory
- [x] Book factory

- [x] Category Resource
- [x] Publisher Resource
- [x] Book Resource

- [x] Seeders with test data

- [ ] UserContext category API tests
- [ ] UserContext book API tests
- [ ] UserContext publisher API tests

- [ ] Query params category API tests
- [ ] Query params book API tests
- [ ] Query params publisher API tests

- [ ] API routes category
- [ ] API routes book
- [ ] API routes publisher



#### References
Query (3.4) https://tools.ietf.org/html/rfc3986 (March 23rd 2018)

ISO 639-1 language codes https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes

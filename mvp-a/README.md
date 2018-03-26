# MVP-A
MVP using laravel-translatable by spatie

https://github.com/spatie/laravel-translatable


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

#### Category

| field     | type                |
| --------- | --------------------|
| id        | increments          |
| name      | varchar             |
| parent_id | foreignkey, integer |
| image_url | varchar             |


### REST API Specification

| Category                    | Book                         | Publisher                 |
|-----------------------------|------------------------------|---------------------------|
| /api/category               | /api/book                    | /api/publisher            |
| /api/category/{id}          | /api/book/{id}               | /api/publisher/{id}       |
| /api/category/{id}/books    | /api/book/{id}/categories    | /api/publisher/{id}/books |
| /api/category/{id}/children |                              |                           |

#### API responses per language
Querying the language for each translatable entity is possible in the following ways

- Query parameters (Query (3.4) https://tools.ietf.org/html/rfc3986 (March 23rd 2018))
- User Context (user preferences)


#### TODO

- [x] Book model tests
- [ ] Publisher model tests
- [ ] Category model tests

- [ ] UserContext category API tests
- [ ] UserContext book API tests
- [ ] UserContext publisher API tests

- [x] Category migration
- [x] Publisher migration
- [x] Book migration

- [ ] User factory
- [ ] Category factory
- [x] Publisher factory
- [x] Book factory

- [ ] Category Resource
- [ ] Publisher Resource
- [ ] Book Resource

- [ ] Seeders with test data

- [ ] API routes category
- [ ] API routes book
- [ ] API routes publisher



#### References
Query (3.4) https://tools.ietf.org/html/rfc3986 (March 23rd 2018)

ISO 639-1 language codes https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes

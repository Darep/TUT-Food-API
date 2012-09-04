# TUT Food API

Simple wrapper for scraping/fetching the restaurant information & food menus of [Tampere University of Technology][].

## API

### `GET /` <small>(proposal)</small>

Returns an array of all the restaurants and their menus.

##### Example request

    $ curl -i "http://tut-food-api.local/"

##### Example response

```json
HTTP/1.1 200 OK
Content-type: application/json

[
    {
        "id": "edison",
        "name": "Edison",
        "open_hours": "",
        "menu": [
            ""
        ]
    },
    {
        "id": "newton",
        "name": "Newton",
        "open_hours": "",
        "menu": [
            ""
        ]
    },
    {
        "id": "zip",
        "name": "Zip",
        "open_hours": "",
        "menu": [
            ""
        ]
    }
]
```


---

### `GET /restaurants` <small>(proposal)</small>

Returns a list of the restaurant IDs.

##### Example request

    $ curl -i "http://tut-food-api.local/restaurants"

##### Example response

    TODO: response

---

### `GET /{restaurant_id}` <small>(proposal)</small>

Returns the information of specified restaurant.

##### Parameters

`string restaurant`
:   Unique restaurant ID

##### Example request

    $ curl -i "http://tut-food-api.local/zip"

##### Example response

    TODO: response

---

### `GET /{restaurant_id}/menu` <small>(proposal)</small>

Returns the menu for the specified restaurant.

##### Parameters

`string restaurant`
:   Unique restaurant ID

##### Example request

    $ curl -i "http://tut-food-api.local/zip/menu"

##### Example response

    TODO: response

---

### Notes

- Restaurant ID can't be "restaurants"


## License

MIT License.

  [Tampere University of Technology]: http://tut.fi/

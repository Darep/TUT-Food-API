# TUT Food API

Simple wrapper for scraping/fetching the restaurant information & food menus of [Tampere University of Technology][].

## API

### `GET /` <small>(proposal)</small>

Returns an array of all the restaurants and their menus.

##### Example request

    $ curl -i "http://tut-food-api.local/"

##### Example response

    HTTP/1.1 200 OK
    Content-type: application/json

```json
[
    {
        "edison": {
            "name": "Edison",
            "open_hours": "",
            "menu": [
                ""
            ]
        },
        "newton": {
            "name": "Newton",
            "open_hours": "",
            "menu": [
                ""
            ]
        },
        "zip": {
            "name": "Zip",
            "open_hours": "",
            "menu": [
                ""
            ]
        }
    }
]
```


---

### `GET /restaurants` <small>(proposal)</small>

Returns a list of the restaurant IDs.

---

### `GET /{restaurant_id}` <small>(proposal)</small>

Returns the information of specified restaurant.

##### Parameters

`string restaurant`
:   Unique restaurant ID

---

### `GET /{restaurant_id}/menu` <small>(proposal)</small>

- `string restaurant` -- unique restaurant ID

Returns the menu for the specified restaurant.


## License

MIT License.

  [Tampere University of Technology]: http://tut.fi/

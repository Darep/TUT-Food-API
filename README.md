# TUT Food API

Simple wrapper for scraping/fetching the restaurant information & food menus of [Tampere University of Technology][].

## API

### `GET /` <small>(proposal)</small>

Returns an array of all the restaurants and their menus.

---

### `GET /restaurants` <small>(proposal)</small>

Returns a list of the restaurant IDs.

---

### `GET /{restaurant}` <small>(proposal)</small>

- `string restaurant` -- unique restaurant ID

Returns the information of specified restaurant.

---

### `GET /{restaurant}/menu` <small>(proposal)</small>

- `string restaurant` -- unique restaurant ID

Returns the menu for the specified restaurant.


## License

MIT License.

  [Tampere University of Technology]: http://tut.fi/

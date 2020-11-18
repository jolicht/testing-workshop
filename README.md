# Testing Workshop

## Tests

## 1. Erste Tests - erste Assertions

Bitte Unit Tests für die Klasse `App\User` implementieren.

* Branch: [erste-tests-erste-assertions](https://github.com/jolicht/testing-workshop/tree/erste-tests-erste-assertions)

## 2. Data Providers

Bitte Klasse `App\AddressFormatter` unter Zuhilfename eines [data providers](https://phpunit.readthedocs.io/en/9.3/writing-tests-for-phpunit.html#data-providers) testen.

* Branch: [data-providers-verwenden](https://github.com/jolicht/testing-workshop/tree/data-providers-verwenden)

## 3. Stubs und Mocks

Bitte Tests für `App\CreateUserHandler` unter Zuhilfenahme von 
[Stubs](https://phpunit.readthedocs.io/en/9.3/test-doubles.html#stubs) und [Mocks](https://phpunit.readthedocs.io/en/9.3/test-doubles.html#mock-objects) implementieren.

* Branch: [stubs-und-mocks](https://github.com/jolicht/testing-workshop/tree/stubs-und-mocks)

## 4. Exceptions

Bitte Klasse `App\User` testen, siehe [Testing Exceptions](https://phpunit.readthedocs.io/en/9.3/writing-tests-for-phpunit.html#testing-exceptions).

* Branch: [exceptions](https://github.com/jolicht/testing-workshop/tree/exceptions)

## 5. Code coverage report

* Branch: [code-coverage](https://github.com/jolicht/testing-workshop/tree/code-coverage)

## 6. Fake Object
* Tests und Klasse stehen schon bereit. Ohne die Api Klassen und die Tests zu ändern soll ein Fake object für den HTTP Client implementiert werden um remote calls zu folgender API zu simulieren.
* Es dürfen nur neue Klassen angelegt und die setUp() methode der Tests geändert werden.
* Api erwartet sich einen Authorization Header mit Bearer Token -> 401 wenn missing 403 wenn invalid.
* Weitere infos stehen im PhpDoc des Tests

* Branch: [fake-object](https://github.com/jolicht/testing-workshop/tree/fake-object)

#### GET /user/id
* 404 Wenn nicht gefunden
```json
{
    "id": 1234
    "email": "test@test.at"
}
```
#### POST /user
* Legt benutzer an
* erwartet sich json body mit {"email": <string>}
* Gibt id des erstellten Benutzers zurück
* 400 Wenn keine gültige E-Mail übergeben wird
* GMail Addressen werden aufgrund einer Klage von Schrems ebenfalls nicht unterstützt und geben einen 400 zurück.

```json
{
    "id": 1234
}
```

## 7. phpspec

Bitte `App\CreateUserHandler` mit [phpspec](https://www.phpspec.net/en/stable/manual/introduction.html) testen.

* Branch: [phpspec](https://github.com/jolicht/testing-workshop/tree/phpspec)

## Links

* [PHPUnit Manual](https://phpunit.readthedocs.io/)
* [phpspec manual](http://www.phpspec.net/en/stable/manual/introduction.html)

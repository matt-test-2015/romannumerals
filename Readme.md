## Roman Numerals Kata

Provides a REST API for conversion of Roman Numerals

#### Usage

```sh
wget http://localhost:8000/integers/1
wget http://localhost:8000/romannumerals/I
```
#### Installation

clone the repo and run ```composer install```

#### Running

from the public directory execute
```sh
php -S localhost:8000
```
#### Running tests
```sh
bin/behat
bin/phpspec run
```
*note: php web server will need to be running for behat to work*
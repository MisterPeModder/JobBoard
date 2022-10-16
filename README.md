OneBoard  
[![License](https://img.shields.io/github/license/MisterPeModder/JobBoard)](https://github.com/MisterPeModder/JobBoard)
=========================

# Running

### Required
* Docker
* Docker Compose
* Linux, MacOS, or Windows (via WSL2)
* [PHP Composer](https://getcomposer.org/)

(see the [laravel docs](https://laravel.com/docs/9.x/installation#laravel-and-docker) for more information on how to install these).

### Installing

Run the following commands in your terminal:
```sh
composer update
composer install
npm install
```

### Development 

Run the following commands in your terminal:
```sh
php artisan key:generate
cp .env.example .env
./vendor/bin/sail up
npm run dev
```

### Production 

Run the following commands in your terminal:
```sh
npm run build
./vendor/bin/sail up
```

# Documentation

(WIP: Link to Notion docs)

# License

The MIT License (MIT)

Copyright © 2022 Melvin Courjaud, Yanis Guaye

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

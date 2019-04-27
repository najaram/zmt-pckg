# Zmto

[![Build Status][ico-travis]][link-travis]

A simple Zomato wrapper for Laravel.

## Installation

Via Composer

``` bash
$ composer require najaram/zmto
```

## Usage
```php
<?php

use Najaram\Zmto\Zmto;

class ExampleController extends Controller
{
    public function index(Zmto $zmto)
    {
        $response = $zmto->makeRequest(
            'GET',
            'search',
            request()->all()
        );
    }
}

```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email arambulo.jan@gmail.com instead of using the issue tracker.


## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/najaram/zmto.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/najaram/zmto.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/najaram/zmto/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/najaram/zmto
[link-downloads]: https://packagist.org/packages/najaram/zmto
[link-travis]: https://travis-ci.org/najaram/zmto
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/najaram
[link-contributors]: ../../contributors

# Response Builder

[![Latest Version on Packagist](https://img.shields.io/packagist/v/turksoy/responsebuilder.svg?style=flat-square)](https://packagist.org/packages/turksoy/responsebuilder)
[![Build Status](https://img.shields.io/travis/turksoy/responsebuilder/master.svg?style=flat-square)](https://travis-ci.org/turksoy/responsebuilder)
[![Quality Score](https://img.shields.io/scrutinizer/g/turksoy/responsebuilder.svg?style=flat-square)](https://scrutinizer-ci.com/g/turksoy/responsebuilder)
[![Total Downloads](https://img.shields.io/packagist/dt/turksoy/responsebuilder.svg?style=flat-square)](https://packagist.org/packages/turksoy/responsebuilder)


## Installation

You can install the package via composer:

```bash
composer require turksoy/responsebuilder
```

## Basic Usage


``` php
Add in Handler.php

    use Turksoy\ResponseBuilder\Traits\ResponseBuilderExceptionHandler;

class Handler extends ExceptionHandler
{

    use ResponseBuilderExceptionHandler;
    ...
}
```

``` php
Add in controller use ResponseBuilder;

    $user = [
        'id'    => 1,
        'name'  => 'hakan',
        'email' => 'hakanturksoy@yandex.com'
    ];
    
    $token = 'sakljSDAIASDKJERNMWE';

    return ResponseBuilder::result('user',$user)
        ->result('token',$token)
        ->ok();

```

``` json
{
    "meta": {
        "messages": {
            "success": [],
            "warning": [],
            "error": [],
            "validation_error": []
        }
    },
    "payload": {
        "user": {
            "id": 1,
            "name": "hakan",
            "email": "hakanturksoy@yandex.com"
        },
        "token": "sakljSDAIASDKJERNMWE"
    }
}
```

``` php
Add in controler use ResponseBuilder;

    return ResponseBuilder::message('error','User not found!')
        ->badRequest();

```
``` json
{
    "meta": {
        "messages": {
            "success": [],
            "warning": [],
            "error": [
                "User not found!"
            ],
            "validation_error": []
        }
    },
    "payload": null
}
```


### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email hakanturksoy@yandex.com instead of using the issue tracker.

## Credits

- [Hakan Türksoy](https://github.com/hkntrksy)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).

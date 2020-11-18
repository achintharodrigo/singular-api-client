# singular-api-client

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Simple Singular Integration

## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practices by being named the following.

```
bin/        
build/
docs/
config/
src/
tests/
vendor/
```


## Install

Via Composer

``` bash
$ composer require achintharodrigo/singular-api-client
```

## Usage

``` php
$singular = new AchinthaRodrigo\SingularApiClient();
echo $singular->echoPhrase('Hello, League!');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email achintha@gmail.com instead of using the issue tracker.

## Credits

- [Achintha Rodrigo][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/achintharodrigo/singular-api-client.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/achintharodrigo/singular-api-client/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/achintharodrigo/singular-api-client.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/achintharodrigo/singular-api-client.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/achintharodrigo/singular-api-client.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/achintharodrigo/singular-api-client
[link-travis]: https://travis-ci.org/achintharodrigo/singular-api-client
[link-scrutinizer]: https://scrutinizer-ci.com/g/achintharodrigo/singular-api-client/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/achintharodrigo/singular-api-client
[link-downloads]: https://packagist.org/packages/achintharodrigo/singular-api-client
[link-author]: https://github.com/achintharodrigo
[link-contributors]: ../../contributors

# 9psb-api-client-php

[![Latest Stable Version](https://img.shields.io/github/v/release/brokeyourbike/9psb-api-client-php)](https://github.com/brokeyourbike/9psb-api-client-php/releases)
[![Total Downloads](https://poser.pugx.org/brokeyourbike/9psb-api-client/downloads)](https://packagist.org/packages/brokeyourbike/9psb-api-client)
[![Maintainability](https://api.codeclimate.com/v1/badges/065b782514bfd5a44cef/maintainability)](https://codeclimate.com/github/brokeyourbike/9psb-api-client-php/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/065b782514bfd5a44cef/test_coverage)](https://codeclimate.com/github/brokeyourbike/9psb-api-client-php/test_coverage)

9PSB API Client for PHP

## Installation

```bash
composer require brokeyourbike/9psb-api-client
```

## Usage

```php
use BrokeYourBike\NinePSB\Interfaces\ConfigInterface;
use BrokeYourBike\NinePSB\Client;

assert($config instanceof ConfigInterface);
assert($httpClient instanceof \GuzzleHttp\ClientInterface);

$apiClient = new Client($config, $httpClient);
$apiClient->transfer($transaction);
```

## Authors
- [Ivan Stasiuk](https://github.com/brokeyourbike) | [Twitter](https://twitter.com/brokeyourbike) | [LinkedIn](https://www.linkedin.com/in/brokeyourbike) | [stasi.uk](https://stasi.uk)

## License
[Mozilla Public License v2.0](https://github.com/brokeyourbike/9psb-api-client-php/blob/main/LICENSE)

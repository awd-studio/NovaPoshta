<h1 align="center">NovaPoshta API SDK for PHP</h1>

<p align="center">PHP-library to work with the <a href="https://devcenter.novaposhta.ua/docs/services/">NovaPoshta API v2</a>.</p>

<p align="center">
<a href="https://travis-ci.org/awd-studio/NovaPoshta" title="Build Status"><img src="https://travis-ci.org/awd-studio/NovaPoshta.svg?branch=dev" alt="Build Status" /></a>
<a href="https://coveralls.io/github/awd-studio/NovaPoshta" title="Coverage Status"><img src="https://coveralls.io/repos/github/awd-studio/NovaPoshta/badge.svg" alt="Coverage Status" /></a>
<a href="https://packagist.org/packages/awd-studio/NovaPoshta" title="Latest Stable Version"><img src="https://poser.pugx.org/awd-studio/NovaPoshta/v/stable" alt="Latest Stable Version" /></a>
<a href="https://packagist.org/packages/awd-studio/NovaPoshta" title="Total Downloads"><img src="https://poser.pugx.org/awd-studio/NovaPoshta/downloads" alt="Total Downloads" /></a>
<a href="https://github.com/awd-studio/NovaPoshta/blob/dev/LICENSE" title="License"><img src="https://poser.pugx.org/awd-studio/NovaPoshta/license" alt="License" /></a>
</p>

### About Nova Poshta company:

Today Nova Poshta is a leader in express delivery owing to its innovation approach and hard work on efficiency improvement. By anticipating Client needs, the company constantly comes up with new products and services.

Nova Poshta’s business isn’t solely about parcels and cargoes delivery. We pride ourselves in e-commerce market development and deployment of complex technological solutions helping businesses to expand on the international scale.

Nova Poshta puts into your service:

- Over 2500 depots all over Ukraine
- Over 2500 vehicles
- 36 cutting-edge sorting stations
- Over 16 000 qualified employees
- More than 60 million shipments a year
- Over 350 cash desks carrying out money transfers
- Modern logistics complex of 4000 sq. m.
- Transparent fees and loyalty programs
- Dedicated customer service and support
- Track and Trace

*[More information](https://novaposhta.ua/en/o_kompanii/nova_poshta_sogodni).*

### Install:
```bash
composer require 'awd-studio/novaposhta:^2.0@dev'
```

### Uninstall:
```bash
composer remove awd-studio/novaposhta
```

## Requirements
- PHP 7.2+
- [Composer](https://getcomposer.org) package manager
- [API token](https://devcenter.novaposhta.ua/blog/%D0%BF%D0%BE%D0%BB%D1%83%D1%87%D0%B5%D0%BD%D0%B8%D0%B5-api-%D0%BA%D0%BB%D1%8E%D1%87%D0%B0)
- [PHP_CURL](http://php.net/manual/book.curl.php) library for sending HTTP-requests *(you can define your custom HTTP-driver as well)*

### Usage:

#### POST request:
```php
<?php

use \AwdStudio\NovaPoshta\Config;
use \AwdStudio\NovaPoshta\Http\CurlRequestFactory;
use \AwdStudio\NovaPoshta\Method\Address\SearchSettlements;
use \AwdStudio\NovaPoshta\Serialization\JsonSerializer;

// Set up
$apiKey = '[MY_API_KEY]';
$config = Config::create($apiKey);

// Create needle method
$cityName = 'київ';
$limit = 5;
$method = new SearchSettlements();
$method->setCityName($cityName);
$method->setLimit($limit);

// Serialization
$serializer = new JsonSerializer();

// Request
$requestFactory = new CurlRequestFactory();
$requestFactory->setConfig($config);
$requestFactory->setMethod($method);
$requestFactory->setSerializer($serializer);
$request = $requestFactory->build();

// Execute request
$responseData = $request->execute();

// Deserialize response
$response = $serializer->deserialize($responseData);
```

#### GET request:
```php
<?php

use \AwdStudio\NovaPoshta\Config;
use \AwdStudio\NovaPoshta\Http\CurlRequestFactory;
use \AwdStudio\NovaPoshta\Method\Orders\PrintDocument;

// Set up
$apiKey = '[MY_API_KEY]';
$config = Config::create($apiKey);

$docRefs = ['20600000002260'];
$type = 'pdf';
$method = new PrintDocument();
$method->setOrders($docRefs);
$method->setType($type);

// Request
$requestFactory = new CurlRequestFactory();
$requestFactory->setConfig($config);
$requestFactory->setMethod($method);
$request = $requestFactory->build();

// Response
$response = $request->execute();
```

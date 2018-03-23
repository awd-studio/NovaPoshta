<h1 align="center">Powerful & Simple NovaPoshta API SDK for PHP</h1>

<p align="center">Fast and easy, integrate your PHP apps with <a href="https://devcenter.novaposhta.ua/docs/services/">official API</a>.</p>

<p align="center">
<a href="https://travis-ci.org/awd-studio/NovaPoshta" title="Build Status"><img src="https://travis-ci.org/awd-studio/NovaPoshta.svg?branch=master" alt="Build Status" /></a>
<a href="https://coveralls.io/github/awd-studio/NovaPoshta" title="Coverage Status"><img src="https://coveralls.io/repos/github/awd-studio/NovaPoshta/badge.svg" alt="Coverage Status" /></a>
<a href="https://packagist.org/packages/awd-studio/NovaPoshta" title="Latest Stable Version"><img src="https://poser.pugx.org/awd-studio/NovaPoshta/v/stable" alt="Latest Stable Version" /></a>
<a href="https://packagist.org/packages/awd-studio/NovaPoshta" title="Total Downloads"><img src="https://poser.pugx.org/awd-studio/NovaPoshta/downloads" alt="Total Downloads" /></a>
<a href="https://github.com/awd-studio/NovaPoshta/blob/master/LICENSE" title="License"><img src="https://poser.pugx.org/awd-studio/NovaPoshta/license" alt="License" /></a>
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


### Very simple usage (see more examples below):
```php
<?php

use NP\NP;

$response = NP::init($key)->sendWith('Address', 'searchSettlements', [
    'StreetName'    => 'Шев',
    'SettlementRef' => 'e715719e-4b33-11e4-ab6d-005056801329',
    'Limit'         => 10,
]);
```

## Requirements
- PHP 7+
- [Composer](https://getcomposer.org) package manager
- [API token](https://devcenter.novaposhta.ua/blog/%D0%BF%D0%BE%D0%BB%D1%83%D1%87%D0%B5%D0%BD%D0%B8%D0%B5-api-%D0%BA%D0%BB%D1%8E%D1%87%D0%B0)
- [Guzzle](https://github.com/guzzle/guzzle) or [PHP_CURL](http://php.net/manual/book.curl.php) libraries for sending HTTP-requests *(optional - you can define custom HTTP-driver)*


## Install
Via [Composer](https://getcomposer.org/)
```bash
composer require awd-studio/novaposhta
```

## Uninstall
```bash
composer remove awd-studio/novaposhta
```

## Usage:

```php
<?php

use NP\NP;

$np = NP::init(['key' => 'yourApiKey', 'driver' => $yourDriver]);

// Simple usage methods:
$np->with('modelName', 'methodName', $data);
$response = $np->send();

// Or more simple:
$response = $np->sendWith('modelName', 'methodName', $data);
```

[See details.](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed) All methods implements.

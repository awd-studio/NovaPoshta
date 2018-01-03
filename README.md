<center>
# Powerful & Simple PHP SDK for NovaPoshta API (alpha)
</center>
## Integrate your PHP apps with [NovaPoshta](https://novaposhta.ua) post company API

This open-source library allows you to integrate Nova Poshta API into your apps.
Fast and easy, you can do everything you want from [official API](https://devcenter.novaposhta.ua/docs/services/).

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


## Requirements
- PHP v5.5 or higher *(PHP 7+ is recommended)*
- [Composer](https://getcomposer.org) package manager
- An [API token](https://devcenter.novaposhta.ua/blog/%D0%BF%D0%BE%D0%BB%D1%83%D1%87%D0%B5%D0%BD%D0%B8%D0%B5-api-%D0%BA%D0%BB%D1%8E%D1%87%D0%B0)
- [Guzzle](https://github.com/guzzle/guzzle) or [PHP_CURL](http://php.net/manual/book.curl.php) libraries for sending HTTP-requests *(optional - you can define yourself HTTP-driver)*

## Install
```bash
composer require awd-studio/nova-poshta
```


## Usage:

```php
<?php

use NP\NP;

$np = NP::init('key', $driver);

// Simple usage methods:
$np->with('modelName', 'methodName', $data);
$response = $np->send();

// Or more simple:
$response = $np->sendWith('modelName', 'methodName', $data);


// Some frequently used methods has more simple usage:
$response = NPStat::track('key', $data, $driver);
```

[See details.](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed) All methods implements.

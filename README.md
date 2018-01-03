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

### Very simple usage example:
```php
<?php

use NP\NP;

$response = NP::init($key)->sendWith('Address', 'searchSettlements', [
    'StreetName'    => 'Шев',
    'SettlementRef' => 'e715719e-4b33-11e4-ab6d-005056801329',
    'Limit'         => 10,
]);
```

##Usage: 

```php
<?php

use NP\NP;

$np = NP::init('key', $driver);

$np->with('modelName', 'methodName', $data);
$np->send();

$response = $np->getResponse();

// Static usage
// $response = NPStat::track('key', $data, $driver);
```

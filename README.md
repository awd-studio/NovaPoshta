##Usage: 

```php
<?php

use NP\NP;

$np = NP::init('key', $driver);

$np->with('modelName', 'methodName', $data);
$np->send();

$response = $np->getResponse();
```

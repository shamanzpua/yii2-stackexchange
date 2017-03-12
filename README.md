# Stackexchange yii2

Yii2 stackexchange api component

## Installation

Add to composer.json
````
 "require": {
    "shamanzpua/yii2stackexchange": "*"
 }
````
#### Configuration:

```php
<?php
'stackexchange' => [
    'class' => 'shamanzpua\yii2stackexchange\Stackexchange',
    'apiKey' => 'YOUR_API_KEY',
    'apis' => [
        'stackoverflow' => [
        'class' => 'shamanzpua\stackexchange\Stackoverflow'
        ],
    ],
]
```

#### Usage:

```php
<?php

$stack = Yii::$app->stackexchange->getApi('stackoverflow');
$data = $stack->grab('search keyword');
```

## Bloom Filter

## install
```shell script
composer require xiaker/bloom-filter
```

## usage

```php
<?php

declare(strict_types=1);

use Symfony\Component\Finder\Finder;
use Xiaker\Bloom\Digest\BkdrDigest;
use Xiaker\Bloom\Digest\DekDigest;
use Xiaker\Bloom\Digest\DjbDigest;
use Xiaker\Bloom\Digest\ElfDigest;
use Xiaker\Bloom\Digest\FnvDigest;
use Xiaker\Bloom\Digest\JsDigest;
use Xiaker\Bloom\Digest\PjwDigest;
use Xiaker\Bloom\Digest\SdbDigest;
use Xiaker\Bloom\Filter;

require __DIR__ . '/vendor/autoload.php';

$redis = new Redis();
$redis->connect('127.0.0.1');

$digests = [
    new BkdrDigest(),
    new DekDigest(),
    new DjbDigest(),
    new ElfDigest(),
    new FnvDigest(),
    new JsDigest(),
    new PjwDigest(),
    new SdbDigest(),
];

$filter = new Filter($redis, ...$digests);

$filter->add('fatrbaby');

if ($filter->exists('fatrbaby')) {
    ...
}
```
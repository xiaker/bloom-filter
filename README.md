## Bloom Filter

## install
```shell script
composer require xiaker/bloom-filter
```

## usage

```php
...

use Xiaker\Bloom\Bucket\ModBucket;
use Xiaker\Bloom\Digest\BkdrDigest;
use Xiaker\Bloom\Digest\DekDigest;
use Xiaker\Bloom\Digest\DjbDigest;
use Xiaker\Bloom\Digest\ElfDigest;
use Xiaker\Bloom\Digest\FnvDigest;
use Xiaker\Bloom\Digest\JsDigest;
use Xiaker\Bloom\Digest\PjwDigest;
use Xiaker\Bloom\Digest\SdbDigest;
use Xiaker\Bloom\Filter;

$redis = new Redis();
$redis->connect('127.0.0.1');

$digests = [ // you can select several or all of them
    new BkdrDigest(),
    new DekDigest(),
    new DjbDigest(),
    new ElfDigest(),
    new FnvDigest(),
    new JsDigest(),
    new PjwDigest(),
    new SdbDigest(),
];

$filter = new Filter(new ModBucket(24), $redis, ...$digests);

$filter->add('fatrbaby');
...

if ($filter->exists('fatrbaby')) {
    ...
}
```
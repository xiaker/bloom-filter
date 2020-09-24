## Bloom Filter

## install
```shell script
composer require xiaker/bloom-filter
```

## usage

```php
...

use Xiaker\Bloom\Bucket\ModBucket;
use Xiaker\Bloom\Digest\BKDRDigest;
use Xiaker\Bloom\Digest\DEKDigest;
use Xiaker\Bloom\Digest\DJBDigest;
use Xiaker\Bloom\Digest\ELFDigest;
use Xiaker\Bloom\Digest\FNVDigest;
use Xiaker\Bloom\Digest\JSDigest;
use Xiaker\Bloom\Digest\PJWDigest;
use Xiaker\Bloom\Digest\SDBMDigest;
use Xiaker\Bloom\Filter;

$redis = new Redis();
$redis->connect('127.0.0.1');

$digests = [ // you can select several or all of them
    new BKDRDigest(),
    new DEKDigest(),
    new DJBDigest(),
    new ELFDigest(),
    new FNVDigest(),
    new JSDigest(),
    new PJWDigest(),
    new SDBMDigest(),
];

$filter = new Filter(new ModBucket(24), $redis, ...$digests);

$filter->add('fatrbaby');
...

if ($filter->exists('fatrbaby')) {
    ...
}
```
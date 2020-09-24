<?php

declare(strict_types=1);

namespace Xiaker\Bloom;

use Redis;
use Xiaker\Bloom\Bucket\Bucket;
use Xiaker\Bloom\Digest\Digest;

class Filter implements FilterInterface
{
    /**
     * @var Bucket
     */
    protected $bucket;

    /**
     * @var Digest[]
     */
    protected $digests;

    /**
     * @var Redis
     */
    protected $redis;

    public function __construct(Bucket $bucket, Redis $redis, Digest ...$digests)
    {
        $this->bucket = $bucket;
        $this->redis = $redis;
        $this->digests = $digests;
    }

    public function add(string $string)
    {
        $bucket = $this->bucket->dispatch($string);

        $pipe = $this->redis->multi();
        foreach ($this->digests as $digest) {
            $pipe->setBit($bucket, $digest->hash($string), true);
        }

        return $pipe->exec();
    }

    public function exists(string $string)
    {
        $bucket = $this->bucket->dispatch($string);

        $pipe = $this->redis->multi();
        $length = strlen($string);

        foreach ($this->digests as $digest) {
            $pipe->getBit($bucket, $digest->hash($string, $length));
        }

        $payloads = $pipe->exec();

        foreach ($payloads as $bit) {
            if (0 == $bit) {
                return false;
            }
        }

        return true;
    }
}

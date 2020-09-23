<?php

declare(strict_types=1);

namespace Xiaker\Bloom;

use Redis;
use Xiaker\Bloom\Digest\Digest;

class Filter
{
    /**
     * @var Digest[]
     */
    protected $digests;

    /**
     * @var Redis
     */
    protected $redis;

    /**
     * Filter constructor.
     * @param Redis $redis
     * @param Digest ...$digests
     */
    public function __construct(Redis $redis, Digest ...$digests)
    {
        $this->redis = $redis;
        $this->digests = $digests;
    }

    public function add(string $string)
    {
        $bucket = $this->getBucket($string);

        $pipe = $this->redis->multi();
        foreach ($this->digests as $digest) {
            $pipe->setBit($bucket, $digest->hash($string), true);
        }

        return $pipe->exec();
    }

    public function exists(string $string)
    {
        $bucket = $this->getBucket($string);

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

    protected function getBucket(string $string)
    {
        $length = strlen($string);

        if ($length <= 1) {
            return '__bloom:small';
        }

        return '__bloom:' . substr(md5($string), 0, 2);
    }
}

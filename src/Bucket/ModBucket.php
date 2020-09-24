<?php

declare(strict_types=1);

namespace Xiaker\Bloom\Bucket;

class ModBucket extends Bucket
{
    public function dispatch(string $key)
    {
        return $this->warp(crc32($key) % $this->total);
    }
}

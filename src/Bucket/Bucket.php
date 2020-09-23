<?php

declare(strict_types=1);

namespace Xiaker\Bloom\Bucket;

abstract class Bucket
{
    /**
     * @var int
     */
    protected $total;

    public function __construct(int $total)
    {
        $this->$total = $total;
    }

    protected function warp($value)
    {
        return '___xiaker:'.$value;
    }

    abstract public function get(string $key);
}

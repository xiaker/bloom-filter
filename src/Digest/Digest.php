<?php

declare(strict_types=1);

namespace Xiaker\Bloom\Digest;

interface Digest
{
    public function hash($string, $length = null);
}

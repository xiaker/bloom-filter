<?php

declare(strict_types=1);

namespace Xiaker\Bloom\Digest;

/**
 * From SDBM project
 */
class SDBMDigest implements Digest
{
    public function hash($string, $length = null)
    {
        $hash = 0;

        if (null === $length) {
            $length = strlen($string);
        }

        for ($i = 0; $i < $length; ++$i) {
            $hash = (int) (ord($string[$i]) + ($hash << 6) + ($hash << 16) - $hash);
        }

        return ($hash % 0xFFFFFFFF) & 0xFFFFFFFF;
    }
}

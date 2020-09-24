<?php

declare(strict_types=1);

namespace Xiaker\Bloom\Digest;

/**
 * Invented by Donald E. Knuth
 */
class DEKDigest implements Digest
{
    public function hash($string, $length = null)
    {
        if (null === $length) {
            $length = strlen($string);
        }

        $hash = $length;

        for ($i = 0; $i < $length; ++$i) {
            $hash = (($hash << 5) ^ ($hash >> 27)) ^ ord($string[$i]);
        }

        return ($hash % 0xFFFFFFFF) & 0xFFFFFFFF;
    }
}

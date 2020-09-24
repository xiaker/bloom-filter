<?php

declare(strict_types=1);

namespace Xiaker\Bloom\Digest;

/**
 * From "The C Programming Language" author: Brian Kernighan & Dennis Ritchie
 */
class BKDRDigest implements Digest
{
    public function hash($string, $length = null)
    {
        $seed = 131;  // 31 131 1313 13131 131313 etc..
        $hash = 0;

        if (null === $length) {
            $length = strlen($string);
        }

        for ($i = 0; $i < $length; ++$i) {
            $hash = (int) (($hash * $seed) + ord($string[$i]));
        }

        return ($hash % 0xFFFFFFFF) & 0xFFFFFFFF;
    }
}

<?php

declare(strict_types=1);

namespace Xiaker\Bloom\Digest;

/**
 * Invented by Daniel J. Bernstein
 */
class DJBDigest implements Digest
{
    public function hash($string, $length = null)
    {
        $hash = 5381;

        if (null === $length) {
            $length = strlen($string);
        }

        for ($i = 0; $i < $length; ++$i) {
            $hash = (int) (($hash << 5) + $hash) + ord($string[$i]);
        }

        return ($hash % 0xFFFFFFFF) & 0xFFFFFFFF;
    }
}

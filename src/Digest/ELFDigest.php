<?php

declare(strict_types=1);

namespace Xiaker\Bloom\Digest;

/**
 * Like PjwDigest
 */
class ELFDigest implements Digest
{
    public function hash($string, $length = null)
    {
        $hash = 0;

        if (null === $length) {
            $length = strlen($string);
        }

        for ($i = 0; $i < $length; ++$i) {
            $hash = ($hash << 4) + ord($string[$i]);
            $x = $hash & 0xF0000000;

            if (0 != $x) {
                $hash ^= ($x >> 24);
            }

            $hash &= ~$x;
        }

        return ($hash % 0xFFFFFFFF) & 0xFFFFFFFF;
    }
}

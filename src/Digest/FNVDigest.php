<?php

declare(strict_types=1);

namespace Xiaker\Bloom\Digest;

/**
 * @see http://www.isthe.com/chongo/tech/comp/fnv/
 */
class FNVDigest implements Digest
{
    public function hash($string, $length = null)
    {
        $prime = 16777619; // prime 2^24 + 2^8 + 0x93 = 16777619
        $hash = 2166136261; // offset

        if (null === $length) {
            $length = strlen($string);
        }

        for ($i = 0; $i < $length; ++$i) {
            $hash = (int) ($hash * $prime) % 0xFFFFFFFF;
            $hash ^= ord($string[$i]);
        }

        return ($hash % 0xFFFFFFFF) & 0xFFFFFFFF;
    }
}

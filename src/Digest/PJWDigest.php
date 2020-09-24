<?php

declare(strict_types=1);

namespace Xiaker\Bloom\Digest;

/**
 * Invented by Peter J. Weinberger of AT＆T
 */
class PJWDigest implements Digest
{
    public function hash($string, $length = null)
    {
        $bitsInUnsignedInt = 4 * 8; //（unsigned int）（sizeof（unsigned int）* 8）;
        $threeQuarters = ($bitsInUnsignedInt * 3) / 4;
        $oneEighth = $bitsInUnsignedInt / 8;
        $highBits = 0xFFFFFFFF << (int) ($bitsInUnsignedInt - $oneEighth);
        $hash = 0;

        if (null === $length) {
            $length = strlen($string);
        }

        for ($i = 0; $i < $length; ++$i) {
            $hash = ($hash << (int) ($oneEighth)) + ord($string[$i]);
        }

        $test = $hash & $highBits;

        if (0 != $test) {
            $hash = (($hash ^ ($test >> (int) ($threeQuarters))) & (~$highBits));
        }

        return ($hash % 0xFFFFFFFF) & 0xFFFFFFFF;
    }
}

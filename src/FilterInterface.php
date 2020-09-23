<?php

declare(strict_types=1);

namespace Xiaker\Bloom;

interface FilterInterface
{
    public function add(string $string);

    public function exists(string $string);
}

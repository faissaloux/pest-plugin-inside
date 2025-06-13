<?php

declare(strict_types=1);

namespace Faissaloux\PestInside\Contracts;

interface Content
{
    /**
     * @return array<int, string|array<string>>
     */
    public function get(): array;
}

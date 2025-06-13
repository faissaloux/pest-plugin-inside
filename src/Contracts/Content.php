<?php

declare(strict_types=1);

namespace Faissaloux\PestInside\Contracts;

use ArrayAccess;
use Countable;
use IteratorAggregate;

/**
 * @extends IteratorAggregate<int|string, string|array<string, string>>
 * @extends ArrayAccess<int|string, string|array<string, string>>
 */
interface Content extends ArrayAccess, Countable, IteratorAggregate
{
    public function getExtension(): string;
}

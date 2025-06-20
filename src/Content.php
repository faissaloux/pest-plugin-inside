<?php

declare(strict_types=1);

namespace Faissaloux\PestInside;

use ArrayIterator;
use Faissaloux\PestInside\Contracts\Content as ContentContract;
use Traversable;

final class Content implements ContentContract
{
    /**
     * @var array<int|string, string|array<string, string>>
     */
    private array $content = [];

    private string $extension;

    public function __construct(private string $file)
    {
        $this->extension = pathinfo($this->file, PATHINFO_EXTENSION);

        $this->content = $this->extension === 'php'
            ? include $this->file
            : explode(PHP_EOL, file_get_contents($this->file) ?: '');
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function count(): int
    {
        return count($this->content);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->content);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->content[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->content[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->content[] = $value;
        } else {
            $this->content[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->content[$offset]);
    }
}

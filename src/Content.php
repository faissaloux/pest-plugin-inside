<?php

declare(strict_types=1);

namespace Faissaloux\PestInside;

use Faissaloux\PestInside\Contracts\Content as ContentContract;

final class Content implements ContentContract
{
    public string $source;

    public function __construct(private string $file)
    {
        $this->source = pathinfo($this->file, PATHINFO_EXTENSION);
    }

    /**
     * {@inheritdoc}
     */
    public function get(): array
    {
        if ($this->source === 'php') {
            $content = include $this->file;
        } else {
            $content = file_get_contents($this->file);
            $content = explode("\n", $content ?: '');
        }

        return $content;
    }
}

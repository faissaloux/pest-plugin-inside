<?php

declare(strict_types=1);

namespace Faissaloux\PestInside;

use Pest\Expectation as PestExpectation;

class Inside
{
    /**
     * @var array<string>
     */
    protected array $files;

    public function __construct(protected string $value)
    {
        $this->files = [$value];
    }

    protected function fetchFilesIfDirectory(int $depth): void
    {
        if (is_dir($this->files[0])) {
            $this->files = getFilesIn($this->files[0], $depth);
        }
    }

    protected function checkFileExistence(string $file): void
    {
        if (! file_exists($file)) {
            expect(true)->toBeFalse("$file not found!");
        }
    }

    /**
     * @return array<string>
     */
    protected function getContentFrom(string $file): array
    {
        $content = include $file;

        expect($content)->toBeArray();

        return $content;
    }

    /**
     * @return PestExpectation<string>
     */
    protected function applyOnDirectory(int $depth, callable $callback): PestExpectation
    {
        $this->fetchFilesIfDirectory($depth);

        if ($this->files === []) {
            expect(true)->toBeTrue();

            return new PestExpectation($this->value);
        }

        foreach ($this->files as $file) {
            $this->checkFileExistence($file);

            $content = $this->getContentFrom($file);

            $callback($file, $content);
        }

        return new PestExpectation($this->value);
    }
}

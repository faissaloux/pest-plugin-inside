<?php

declare(strict_types=1);

namespace Faissaloux\PestInside;

use Pest\Expectation as PestExpectation;

final class Expectation
{
    /**
     * @var array<string>
     */
    private array $files;

    public function __construct(private string $value)
    {
        $this->files = [$value];
    }

    private function fetchFilesIfDirectory(int $depth): void
    {
        if (is_dir($this->files[0])) {
            $this->files = getFilesIn($this->files[0], $depth);
        }
    }

    private function checkFileExistence(string $file): void
    {
        if (! file_exists($file)) {
            expect(true)->toBeFalse("$file not found!");
        }
    }

    /**
     * @return array<string>
     */
    private function getContentFrom(string $file): array
    {
        $content = include $file;

        expect($content)->toBeArray();

        return $content;
    }

    /**
     * @return PestExpectation<string>
     */
    public function toReturnLowercase(int $depth = -1): PestExpectation
    {
        $this->fetchFilesIfDirectory($depth);

        if ($this->files === []) {
            expect(true)->toBeTrue();

            return new PestExpectation($this->value);
        }

        foreach ($this->files as $file) {
            $this->checkFileExistence($file);

            $content = $this->getContentFrom($file);

            // Clean up content from numerics and special characters.
            $cleanContent = array_map(function (string $word): string {
                return (string) preg_replace('/[^A-Za-z]/', '', $word);
            }, $content);

            foreach ($cleanContent as $key => $word) {
                if ($word === '') {
                    continue;
                }

                expect($word)->toBeLowercase("Not lowercase word detected: $content[$key] in $file");
            }
        }

        return new PestExpectation($this->value);
    }

    /**
     * @return PestExpectation<string>
     */
    public function toReturnUnique(int $depth = -1): PestExpectation
    {
        $this->fetchFilesIfDirectory($depth);

        if ($this->files === []) {
            expect(true)->toBeTrue();

            return new PestExpectation($this->value);
        }

        foreach ($this->files as $file) {
            $this->checkFileExistence($file);

            $content = $this->getContentFrom($file);

            $duplicates = array_diff_assoc($content, array_unique($content));

            expect($duplicates)->toBeEmpty('Duplicates found:'.implode(',', $duplicates)." in $file");
        }

        return new PestExpectation($this->value);
    }
}

<?php

declare(strict_types=1);

namespace Faissaloux\PestInside;

use Pest\Expectation as PestExpectation;

final class Expectation
{
    public function __construct(private string $value) {}

    /**
     * @return PestExpectation<string>
     */
    public function toReturnLowercase(int $depth = -1): PestExpectation
    {
        $files = [$this->value];
    
        if (is_dir($files[0])) {
            $files = getFilesIn($files[0], $depth);

            if ($files === []) {
                expect(true)->toBeTrue();

                return new PestExpectation($this->value);
            }
        }

        foreach ((array) $files as $file) {
            if (! file_exists($file)) {
                expect(true)->toBeFalse("$file not found!");
            }

            $content = include $file;

            expect($content)->toBeArray();

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
    public function toReturnUnique(int $depth = -1): PestExpectation {
        $files = [$this->value];
    
        if (is_dir($files[0])) {
            $files = getFilesIn($files[0], $depth);

            if ($files === []) {
                expect(true)->toBeTrue();

                return new PestExpectation($this->value);
            }
        }

        foreach ((array) $files as $file) {
            if (! file_exists($file)) {
                expect(true)->toBeFalse("$file not found!");
            }

            $content = include $file;

            expect($content)->toBeArray();

            $duplicates = array_diff_assoc($content, array_unique($content));

            expect($duplicates)->toBeEmpty('Duplicates found:'.implode(',', $duplicates)." in $file");
        }

        return new PestExpectation($this->value);
    }
        
}

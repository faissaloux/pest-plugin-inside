<?php

declare(strict_types=1);

namespace Faissaloux\PestInside;

final class Expectation extends Inside
{
    public function toReturnLowercase(int $depth = -1): void
    {
        $this->applyOnDirectory($depth, function ($file, $content) {
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
        });
    }

    public function toReturnUnique(int $depth = -1): void
    {
        $this->applyOnDirectory($depth, function (string $file, array $content): void {
            $duplicates = array_diff_assoc($content, array_unique($content));

            expect($duplicates)->toBeEmpty('Duplicates found: '.implode(',', $duplicates)." in $file");
        });
    }

    public function toReturnSingleWords(int $depth = -1): void
    {
        $this->applyOnDirectory($depth, function (string $file, array $content): void {
            $notSingle = array_filter($content, function (string $word): bool {
                return str_contains(trim($word), ' ');
            });

            expect($notSingle)->toBeEmpty('Not single words detected: '.implode(',', $notSingle)." in $file");
        });
    }
}

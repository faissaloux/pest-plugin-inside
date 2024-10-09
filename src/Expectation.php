<?php

declare(strict_types=1);

use Pest\Expectation as PestExpectation;

expect()->extend(
    'toReturnLowercase',
    function (): PestExpectation {
        $files = [$this->value];

        if (is_dir($files[0])) {
            $directory = $files[0];

            if ($files = scandir($files[0])) {
                $files = array_diff($files, ['.', '..']);
                $files = array_map(fn (string $file): string => $directory.DIRECTORY_SEPARATOR.$file, $files);
            }

            if ($files === []) {
                expect(true)->toBeTrue();

                return $this;
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

                expect($word)->toBeLowercase("Not lowercase word found: $content[$key]");
            }
        }

        return $this;
    }
);

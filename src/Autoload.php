<?php

declare(strict_types=1);

use Pest\Expectation as PestExpectation;

expect()->extend(
    'toReturnLowercase',
    function (): PestExpectation {
        $file = $this->value;

        if (! file_exists($file)) {
            expect(true)->toBeFalse("$file not found!");
        }

        $content = include $file;

        expect($content)->toBeArray();

        // Clean up content from numerics and special characters.
        $cleanContent = array_map(function ($word): string {
            return preg_replace('/[^A-Za-z]/', '', $word);
        }, $content);

        foreach ($cleanContent as $key => $word) {
            if ($word === '') {
                continue;
            }

            expect($word)->toBeLowercase("Not lowercase word found: $content[$key]");
        }

        return $this;
    }
);

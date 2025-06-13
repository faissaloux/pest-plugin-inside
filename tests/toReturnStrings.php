<?php

use PHPUnit\Framework\ExpectationFailedException;

it('passes', function (string $file): void {
    expect($file)->toReturnStrings();
})->with([
    'tests/Fixtures/returnsDuplicates.php',
    'tests/Fixtures/text/returnsDuplicates.stub',
]);

it('passes with not', function (string $file): void {
    expect($file)->not->toReturnStrings();
})->with([
    'tests/Fixtures/returnsMultipleDuplicates.php',
]);

it('passes when all nested arrays content is string', function (): void {
    expect('tests/Fixtures/returnsNestedLowercase.php')
        ->toReturnStrings();
});

it('fails', function (string $file): void {
    expect($file)->toReturnStrings();
})->with([
    'tests/Fixtures/returnsMultipleDuplicates.php',
])->throws(ExpectationFailedException::class);

it('fails with not', function (string $file): void {
    expect($file)->not->toReturnStrings();
})->with([
    'tests/Fixtures/returnsDuplicates.php',
    'tests/Fixtures/text/returnsDuplicates.stub',
])->throws(ExpectationFailedException::class);

it('fails when not all nested arrays content is string', function (): void {
    expect('tests/Fixtures/returnsNestedNotUnique.php')
        ->toReturnStrings();
})->throws(ExpectationFailedException::class, 'Not string detected: 1');

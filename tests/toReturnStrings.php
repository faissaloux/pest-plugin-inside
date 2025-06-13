<?php

use Faissaloux\PestInside\NotSupported;
use PHPUnit\Framework\ExpectationFailedException;

it('passes', function (string $file): void {
    expect($file)->toReturnStrings();
})->with([
    'tests/Fixtures/returnsDuplicates.php',
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
])->throws(ExpectationFailedException::class);

it('fails when not all nested arrays content is string', function (): void {
    expect('tests/Fixtures/returnsNestedNotUnique.php')
        ->toReturnStrings();
})->throws(ExpectationFailedException::class, 'Not string detected: 1');

describe('not supported', function (): void {
    test('files extensions', function (string $file): void {
        expect($file)->toReturnStrings();
    })
        ->with(['tests/Fixtures/text/returnsDuplicates.stub'])
        ->throws(NotSupported::class, 'toReturnStrings is not supported on stub files.');
});

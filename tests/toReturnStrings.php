<?php

use PHPUnit\Framework\ExpectationFailedException;

it('passes', function (): void {
    expect('tests/Fixtures/returnsDuplicates.php')
        ->toReturnStrings();
});

it('passes with not', function (): void {
    expect('tests/Fixtures/returnsMultipleDuplicates.php')
        ->not->toReturnStrings();
});

it('passes when all nested arrays content is string', function (): void {
    expect('tests/Fixtures/returnsNestedLowercase.php')
        ->toReturnStrings();
});

it('fails', function (): void {
    expect('tests/Fixtures/returnsMultipleDuplicates.php')
        ->toReturnStrings();
})->throws(ExpectationFailedException::class);

it('fails with not', function (): void {
    expect('tests/Fixtures/returnsDuplicates.php')
        ->not->toReturnStrings();
})->throws(ExpectationFailedException::class);

it('fails when not all nested arrays content is string', function (): void {
    expect('tests/Fixtures/returnsNestedNotUnique.php')
        ->toReturnStrings();
})->throws(ExpectationFailedException::class, 'Not string detected: 1');

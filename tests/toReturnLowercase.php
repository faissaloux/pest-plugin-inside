<?php

use PHPUnit\Framework\ExpectationFailedException;

it('passes', function (): void {
    expect('tests/Fixtures/returnsArrayOnlyLowercase.php')
        ->toReturnLowercase();
});

it('passes with not', function (): void {
    expect('tests/Fixtures/returnsArrayLowercaseWithUppercase.php')
        ->not->toReturnLowercase();
});

it('fails', function (): void {
    expect('tests/Fixtures/returnsArrayLowercaseWithUppercase.php')
        ->toReturnLowercase();
})->throws(ExpectationFailedException::class);

it('fails with not', function (): void {
    expect('tests/Fixtures/returnsArrayOnlyLowercase.php')
        ->not->toReturnLowercase();
})->throws(ExpectationFailedException::class);

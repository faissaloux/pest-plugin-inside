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

it('passes when directory is e mpty', function (): void {
    expect('tests/Fixtures/empty')
        ->toReturnLowercase();
});

it('passes when all directory files content are lowercase', function (): void {
    expect('tests/Fixtures/shouldAllBeLowercase')
        ->toReturnLowercase();
});

it('fails', function (): void {
    expect('tests/Fixtures/returnsArrayLowercaseWithUppercase.php')
        ->toReturnLowercase();
})->throws(ExpectationFailedException::class);

it('fails with not', function (): void {
    expect('tests/Fixtures/returnsArrayOnlyLowercase.php')
        ->not->toReturnLowercase();
})->throws(ExpectationFailedException::class);

it('fails when file does not exist', function (): void {
    expect('tests/Fixtures/notExist.php')
        ->toReturnLowercase();
})->throws(ExpectationFailedException::class);

it('fails when directory does not exist', function (): void {
    expect('tests/Fixtures/notExist')
        ->toReturnLowercase();
})->throws(ExpectationFailedException::class);

it('fails when not all directory files content are lowercase', function (): void {
    expect('tests/Fixtures/shouldAllBeLowercase1')
        ->toReturnLowercase();
})->throws(ExpectationFailedException::class);

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

it('passes when directory is empty', function (): void {
    expect('tests/Fixtures/empty')
        ->toReturnLowercase();
});

it('passes when all directory files content are lowercase', function (): void {
    expect('tests/Fixtures/directory')
        ->toReturnLowercase(depth: 0);
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
})->throws(ExpectationFailedException::class, 'tests/Fixtures/notExist.php not found');

it('fails when directory does not exist', function (): void {
    expect('tests/Fixtures/notExist')
        ->toReturnLowercase();
})->throws(ExpectationFailedException::class);

it('fails when not all directory files content are lowercase', function (): void {
    expect('tests/Fixtures/directory1')
        ->toReturnLowercase();
})->throws(ExpectationFailedException::class);

it('fails when not all subdirectories files content are lowercase', function (): void {
    expect('tests/Fixtures/directory')
        ->toReturnLowercase();
})->throws(ExpectationFailedException::class);

it('displays words detected', function (): void {
    expect('tests/Fixtures/directory')->toReturnLowercase();
})->throws(ExpectationFailedException::class, 'Not lowercase detected: loWer, nOt');

it('displays file where error detected', function (): void {
    expect('tests/Fixtures/directory')->toReturnLowercase();
})->throws(ExpectationFailedException::class, 'notAllLowerCase.php');

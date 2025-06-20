<?php

use PHPUnit\Framework\ExpectationFailedException;

it('passes', function (string $file): void {
    expect($file)->forbidEmpty();
})->with([
    'tests/Fixtures/returnsMultipleDuplicates.php',
    'tests/Fixtures/text/returnsMultipleDuplicates.stub',
]);

it('fails', function (string $file): void {
    expect($file)->forbidEmpty();
})->with([
    'tests/Fixtures/returnsDuplicates.php',
    'tests/Fixtures/text/returnsDuplicates.stub',
])->throws(ExpectationFailedException::class, 'Empty value detected');

it('passes when directory is empty', function (): void {
    expect('tests/Fixtures/empty')->forbidEmpty();
});

it('fails when directory does not exist', function (): void {
    expect('tests/Fixtures/notExist')->forbidEmpty();
})->throws(ExpectationFailedException::class);

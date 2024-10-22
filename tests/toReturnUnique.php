<?php

use PHPUnit\Framework\ExpectationFailedException;

it('passes', function (): void {
    expect('tests/Fixtures/returnsUnique.php')
        ->toReturnUnique();
});

it('passes with not', function (): void {
    expect('tests/Fixtures/returnsDuplicates.php')
        ->not->toReturnUnique();
});

it('passes when all nested arrays content is unique', function (): void {
    expect('tests/Fixtures/returnsNestedUnique.php')
        ->toReturnUnique();
});

it('passes when directory is empty', function (): void {
    expect('tests/Fixtures/empty')
        ->toReturnUnique();
});

it('passes when all directory files content are unique', function (): void {
    expect('tests/Fixtures/directory')
        ->toReturnUnique(depth: 0);
});

it('fails', function (): void {
    expect('tests/Fixtures/returnsDuplicates.php')
        ->toReturnUnique();
})->throws(ExpectationFailedException::class);

it('fails with not', function (): void {
    expect('tests/Fixtures/returnsUnique.php')
        ->not->toReturnUnique();
})->throws(ExpectationFailedException::class);

it('fails when not all nested arrays content is unique', function (): void {
    expect('tests/Fixtures/returnsNestedNotUnique.php')
        ->toReturnUnique();
})->throws(ExpectationFailedException::class, 'Duplicates detected: pest, inside');

it('fails when file does not exist', function (): void {
    expect('tests/Fixtures/notExist.php')
        ->toReturnUnique();
})->throws(ExpectationFailedException::class, 'tests/Fixtures/notExist.php not found');

it('fails when directory does not exist', function (): void {
    expect('tests/Fixtures/notExist')
        ->toReturnUnique();
})->throws(ExpectationFailedException::class);

it('fails when not all directory files content are unique', function (): void {
    expect('tests/Fixtures/directory1')
        ->toReturnUnique();
})->throws(ExpectationFailedException::class);

it('fails when not all subdirectories files content are unique', function (): void {
    expect('tests/Fixtures/directory')
        ->toReturnUnique();
})->throws(ExpectationFailedException::class);

it('displays found duplicate', function (): void {
    expect('tests/Fixtures/returnsDuplicates.php')
        ->toReturnUnique();
})->throws(ExpectationFailedException::class, 'duplicate');

it('displays multiple found duplicates', function (): void {
    expect('tests/Fixtures/returnsMultipleDuplicates.php')
        ->toReturnUnique();
})->throws(ExpectationFailedException::class, '1, duplicate');

it('displays file where duplicate found', function (): void {
    expect('tests/Fixtures/returnsDuplicates.php')
        ->toReturnUnique();
})->throws(ExpectationFailedException::class, 'returnsDuplicates.php');

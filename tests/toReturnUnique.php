<?php

use PHPUnit\Framework\ExpectationFailedException;

it('passes', function (string $file): void {
    expect($file)->toReturnUnique();
})->with([
    'tests/Fixtures/returnsUnique.php',
    'tests/Fixtures/text/returnsUnique.stub',
]);

it('passes with not', function (string $file): void {
    expect($file)->not->toReturnUnique();
})->with([
    'tests/Fixtures/returnsDuplicates.php',
    'tests/Fixtures/text/returnsDuplicates.stub',
]);

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

it('fails', function (string $file): void {
    expect($file)->toReturnUnique();
})->with([
    'tests/Fixtures/returnsDuplicates.php',
    'tests/Fixtures/text/returnsDuplicates.stub',
])->throws(ExpectationFailedException::class);

it('fails with not', function (string $file): void {
    expect($file)->not->toReturnUnique();
})->with([
    'tests/Fixtures/returnsUnique.php',
    'tests/Fixtures/text/returnsUnique.stub',
])->throws(ExpectationFailedException::class);

it('fails when not all nested arrays content is unique', function (): void {
    expect('tests/Fixtures/returnsNestedNotUnique.php')
        ->toReturnUnique();
})->throws(ExpectationFailedException::class, 'Duplicates detected: pest, inside');

describe('fails when file does not exist', function (): void {
    test('php file', function (): void {
        expect('tests/Fixtures/notExist.php')->toReturnUnique();
    })->throws(ExpectationFailedException::class, 'tests/Fixtures/notExist.php not found');

    test('text file', function (): void {
        expect('tests/Fixtures/notExist.stub')->toReturnUnique();
    })->throws(ExpectationFailedException::class, 'tests/Fixtures/notExist.stub not found');
});

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

it('displays found duplicate', function (string $file): void {
    expect($file)->toReturnUnique();
})->with([
    'tests/Fixtures/returnsDuplicates.php',
    'tests/Fixtures/text/returnsDuplicates.stub',
])->throws(ExpectationFailedException::class, 'duplicate');

it('displays multiple found duplicates', function (string $file): void {
    expect($file)->toReturnUnique();
})->with([
    'tests/Fixtures/returnsMultipleDuplicates.php',
    'tests/Fixtures/text/returnsMultipleDuplicates.stub',
])->throws(ExpectationFailedException::class, '1, duplicate');

describe('displays file where duplicate found', function (): void {
    test('php file', function (): void {
        expect('tests/Fixtures/returnsDuplicates.php')->toReturnUnique();
    })->throws(ExpectationFailedException::class, 'tests/Fixtures/returnsDuplicates.php');

    test('text file', function (): void {
        expect('tests/Fixtures/returnsDuplicates.stub')->toReturnUnique();
    })->throws(ExpectationFailedException::class, 'tests/Fixtures/returnsDuplicates.stub');
});

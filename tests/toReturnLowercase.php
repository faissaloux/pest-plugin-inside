<?php

use PHPUnit\Framework\ExpectationFailedException;

it('passes', function (string $file): void {
    expect($file)->toReturnLowercase();
})->with([
    'tests/Fixtures/returnsArrayOnlyLowercase.php',
    'tests/Fixtures/text/returnsArrayOnlyLowercase.stub',
]);

it('passes with not', function (string $file): void {
    expect($file)->not->toReturnLowercase();
})->with([
    'tests/Fixtures/returnsArrayLowercaseWithUppercase.php',
    'tests/Fixtures/text/returnsArrayLowercaseWithUppercase.stub',
]);

it('passes when all nested arrays content is lowercase', function (): void {
    expect('tests/Fixtures/returnsNestedLowercase.php')
        ->toReturnLowercase();
});

it('passes when directory is empty', function (): void {
    expect('tests/Fixtures/empty')
        ->toReturnLowercase();
});

it('passes when all directory files content are lowercase', function (): void {
    expect('tests/Fixtures/directory')
        ->toReturnLowercase(depth: 0);
});

it('fails', function (string $file): void {
    expect($file)->toReturnLowercase();
})->with([
    'tests/Fixtures/returnsArrayLowercaseWithUppercase.php',
    'tests/Fixtures/text/returnsArrayLowercaseWithUppercase.stub',
])
    ->throws(ExpectationFailedException::class);

it('fails with not', function (string $file): void {
    expect($file)->not->toReturnLowercase();
})->with([
    'tests/Fixtures/returnsArrayOnlyLowercase.php',
    'tests/Fixtures/text/returnsArrayOnlyLowercase.stub',
])->throws(ExpectationFailedException::class);

it('fails when not all nested arrays content is lowercase', function (): void {
    expect('tests/Fixtures/returnsNestedNotAllLowercase.php')
        ->toReturnLowercase();
})->throws(ExpectationFailedException::class, 'Not lowercase detected: inSide');

describe('fails when file does not exist', function (): void {
    test('php file', function (): void {
        expect('tests/Fixtures/notExist.php')->toReturnLowercase();
    })->throws(ExpectationFailedException::class, 'tests/Fixtures/notExist.php not found');

    test('text file', function (): void {
        expect('tests/Fixtures/notExist.stub')->toReturnLowercase();
    })->throws(ExpectationFailedException::class, 'tests/Fixtures/notExist.stub not found');
});

it('fails when directory does not exist', function (): void {
    expect('tests/Fixtures/notExist')
        ->toReturnLowercase();
})->throws(ExpectationFailedException::class);

it('fails when not all directory files content are lowercase', function (string $directory): void {
    expect($directory)->toReturnLowercase();
})->with([
    'tests/Fixtures/directory1',
    'tests/Fixtures/text',
])->throws(ExpectationFailedException::class);

it('fails when not all subdirectories files content are lowercase', function (string $directory): void {
    expect($directory)->toReturnLowercase();
})->with([
    'tests/Fixtures/directory1',
    'tests/Fixtures/text',
])->throws(ExpectationFailedException::class);

it('displays words detected', function (): void {
    expect('tests/Fixtures/directory')->toReturnLowercase();
})->throws(ExpectationFailedException::class, 'Not lowercase detected: loWer, nOt');

it('displays file where error detected', function (): void {
    expect('tests/Fixtures/directory')->toReturnLowercase();
})->throws(ExpectationFailedException::class, 'notAllLowerCase.php');

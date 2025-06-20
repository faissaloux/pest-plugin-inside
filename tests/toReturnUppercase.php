<?php

use PHPUnit\Framework\ExpectationFailedException;

it('passes', function (string $file): void {
    expect($file)->toReturnUppercase();
})->with([
    'tests/Fixtures/returnsArrayOnlyUppercase.php',
    'tests/Fixtures/text/returnsOnlyUppercase.stub',
]);

it('passes with not', function (string $file): void {
    expect($file)->not->toReturnUppercase();
})->with([
    'tests/Fixtures/returnsArrayLowercaseWithUppercase.php',
    'tests/Fixtures/text/returnsArrayLowercaseWithUppercase.stub',
]);

it('passes when all nested arrays content is uppercase', function (): void {
    expect('tests/Fixtures/returnsNestedUppercase.php')
        ->toReturnUppercase();
});

it('passes when directory is empty', function (): void {
    expect('tests/Fixtures/empty')
        ->toReturnUppercase();
});

it('passes when all directory files content are uppercase', function (): void {
    expect('tests/Fixtures/uppercase/allUppercase.php')
        ->toReturnUppercase(depth: 0);
});

it('fails', function (string $file): void {
    expect($file)->toReturnUppercase();
})->with([
    'tests/Fixtures/returnsArrayLowercaseWithUppercase.php',
    'tests/Fixtures/text/returnsArrayLowercaseWithUppercase.stub',
])
    ->throws(ExpectationFailedException::class);

it('fails with not', function (string $file): void {
    expect($file)->not->toReturnUppercase();
})->with([
    'tests/Fixtures/returnsArrayOnlyUppercase.php',
    'tests/Fixtures/text/returnsOnlyUppercase.stub',
])->throws(ExpectationFailedException::class);

it('fails when not all nested arrays content is uppercase', function (): void {
    expect('tests/Fixtures/returnsNestedNotAllUppercase.php')
        ->toReturnUppercase();
})->throws(ExpectationFailedException::class, 'Not uppercase detected: INsIDE');

describe('fails when file does not exist', function (): void {
    test('php file', function (): void {
        expect('tests/Fixtures/notExist.php')->toReturnUppercase();
    })->throws(ExpectationFailedException::class, 'tests/Fixtures/notExist.php not found');

    test('text file', function (): void {
        expect('tests/Fixtures/notExist.stub')->toReturnUppercase();
    })->throws(ExpectationFailedException::class, 'tests/Fixtures/notExist.stub not found');
});

it('fails when directory does not exist', function (): void {
    expect('tests/Fixtures/notExist')
        ->toReturnUppercase();
})->throws(ExpectationFailedException::class);

it('fails when not all directory files content are uppercase', function (string $directory): void {
    expect($directory)->toReturnUppercase();
})->with([
    'tests/Fixtures/directory1',
    'tests/Fixtures/text',
])->throws(ExpectationFailedException::class);

it('fails when not all subdirectories files content are uppercase', function (string $directory): void {
    expect($directory)->toReturnUppercase();
})->with([
    'tests/Fixtures/directory1',
    'tests/Fixtures/text',
])->throws(ExpectationFailedException::class);

it('displays words detected', function (): void {
    expect('tests/Fixtures/directory')->toReturnUppercase();
})->throws(ExpectationFailedException::class, 'Not uppercase detected: f@issa!oux, pest, plugin, inside, lowercase, loWer, case, nOt');

it('displays file where error detected', function (): void {
    expect('tests/Fixtures/directory')->toReturnUppercase();
})->throws(ExpectationFailedException::class, 'notAllLowerCase.php');

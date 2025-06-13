<?php

use PHPUnit\Framework\ExpectationFailedException;

it('passes', function (string $file): void {
    expect($file)->toReturnSingleWords();
})->with([
    'tests/Fixtures/returnsMultipleDuplicates.php',
    'tests/Fixtures/text/returnsMultipleDuplicates.stub',
]);

it('passes with not', function (string $file): void {
    expect($file)->not->toReturnSingleWords();
})->with([
    'tests/Fixtures/returnsUnique.php',
    'tests/Fixtures/text/returnsUnique.stub',
]);

it('passes when all nested arrays content is single words', function (): void {
    expect('tests/Fixtures/returnsNestedSingleWords.php')
        ->toReturnSingleWords();
});

it('passes when directory is empty', function (): void {
    expect('tests/Fixtures/empty')
        ->toReturnSingleWords();
});

it('passes when all directory files content are single words', function (): void {
    expect('tests/Fixtures/directory')
        ->toReturnSingleWords(depth: 0);
});

it('fails', function (string $file): void {
    expect($file)->toReturnSingleWords();
})->with([
    'tests/Fixtures/returnsUnique.php',
    'tests/Fixtures/text/returnsUnique.stub',
])->throws(ExpectationFailedException::class);

it('fails with not', function (string $file): void {
    expect($file)->not->toReturnSingleWords();
})->with([
    'tests/Fixtures/returnsMultipleDuplicates.php',
    'tests/Fixtures/text/returnsMultipleDuplicates.stub',
])->throws(ExpectationFailedException::class);

it('fails when not all nested arrays content is single words', function (): void {
    expect('tests/Fixtures/returnsNestedNotSingleWords.php')
        ->toReturnSingleWords();
})->throws(ExpectationFailedException::class, 'Not single words detected: plugin inside, not single word');

describe('fails when file does not exist', function (): void {
    it('php file', function (): void {
        expect('tests/Fixtures/notExist.php')->toReturnSingleWords();
    })->throws(ExpectationFailedException::class, 'tests/Fixtures/notExist.php not found');

    it('text file', function (): void {
        expect('tests/Fixtures/text/notExist.stub')->toReturnSingleWords();
    })->throws(ExpectationFailedException::class, 'tests/Fixtures/text/notExist.stub not found');
});

it('fails when directory does not exist', function (string $directory): void {
    expect($directory)->toReturnSingleWords();
})->with([
    'tests/Fixtures/notExist',
    'tests/Fixtures/text/notExist',
])->throws(ExpectationFailedException::class);

it('fails when not all directory files content are single words', function (string $directory): void {
    expect($directory)->toReturnSingleWords();
})->with([
    'tests/Fixtures/directory1',
    'tests/Fixtures/text',
])->throws(ExpectationFailedException::class);

it('fails when not all subdirectories files content are single words', function (string $directory): void {
    expect($directory)->toReturnSingleWords();
})->with([
    'tests/Fixtures/directory',
    'tests/Fixtures/text',
])->throws(ExpectationFailedException::class);

it('displays word detected', function (string $directory): void {
    expect($directory)->toReturnSingleWords();
})->with([
    'tests/Fixtures/directory',
    'tests/Fixtures/text',
])->throws(ExpectationFailedException::class, 'Not single words detected: plugin inside');

it('displays multiple not single words detected', function (string $file): void {
    expect($file)->toReturnSingleWords();
})->with([
    'tests/Fixtures/returnsDuplicates.php',
    'tests/Fixtures/text/returnsDuplicates.stub',
])->throws(ExpectationFailedException::class, 'pest plugin, pest plugin inside');

describe('displays file where error detected', function (): void {
    it('php file', function (): void {
        expect('tests/Fixtures/directory')->toReturnSingleWords();
    })->throws(ExpectationFailedException::class, 'notAllUnique.php');

    it('text file', function (): void {
        expect('tests/Fixtures/text')->toReturnSingleWords();
    })->throws(ExpectationFailedException::class, 'returnsArrayOnlyLowercase.stub');
});

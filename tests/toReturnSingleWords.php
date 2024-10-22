<?php

use PHPUnit\Framework\ExpectationFailedException;

it('passes', function (): void {
    expect('tests/Fixtures/returnsMultipleDuplicates.php')
        ->toReturnSingleWords();
});

it('passes with not', function (): void {
    expect('tests/Fixtures/returnsUnique.php')
        ->not->toReturnSingleWords();
});

it('passes when directory is empty', function (): void {
    expect('tests/Fixtures/empty')
        ->toReturnSingleWords();
});

it('passes when all directory files content are single words', function (): void {
    expect('tests/Fixtures/directory')
        ->toReturnSingleWords(depth: 0);
});

it('fails', function (): void {
    expect('tests/Fixtures/returnsUnique.php')
        ->toReturnSingleWords();
})->throws(ExpectationFailedException::class);

it('fails with not', function (): void {
    expect('tests/Fixtures/returnsMultipleDuplicates.php')
        ->not->toReturnSingleWords();
})->throws(ExpectationFailedException::class);

it('fails when file does not exist', function (): void {
    expect('tests/Fixtures/notExist.php')
        ->toReturnSingleWords();
})->throws(ExpectationFailedException::class, 'tests/Fixtures/notExist.php not found');

it('fails when directory does not exist', function (): void {
    expect('tests/Fixtures/notExist')
        ->toReturnSingleWords();
})->throws(ExpectationFailedException::class);

it('fails when not all directory files content are single words', function (): void {
    expect('tests/Fixtures/directory1')
        ->toReturnSingleWords();
})->throws(ExpectationFailedException::class);

it('fails when not all subdirectories files content are single words', function (): void {
    expect('tests/Fixtures/directory')
        ->toReturnSingleWords();
})->throws(ExpectationFailedException::class);

it('displays word detected', function (): void {
    expect('tests/Fixtures/directory')->toReturnSingleWords();
})->throws(ExpectationFailedException::class, 'Not single words detected: plugin inside');

it('displays multiple not single words detected', function (): void {
    expect('tests/Fixtures/returnsDuplicates.php')
        ->toReturnSingleWords();
})->throws(ExpectationFailedException::class, 'pest plugin, pest plugin inside');

it('displays file where error detected', function (): void {
    expect('tests/Fixtures/directory')->toReturnSingleWords();
})->throws(ExpectationFailedException::class, 'notAllUnique.php');

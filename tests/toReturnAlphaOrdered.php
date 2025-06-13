<?php

use PHPUnit\Framework\ExpectationFailedException;

it('passes', function (string $file): void {
    expect($file)->toBeOrdered();
})->with([
    'tests/Fixtures/alphaOrder/arrayOrdered.php',
    'tests/Fixtures/text/arrayOrdered.stub',
]);

it('passes with not', function (string $file): void {
    expect($file)->not->toBeOrdered();
})->with([
    'tests/Fixtures/alphaOrder/arrayNotOrdered.php',
    'tests/Fixtures/text/arrayNotOrdered.stub',
]);

it('passes when all nested arrays content is ordered', function (): void {
    expect('tests/Fixtures/alphaOrder/nestedArrayOrdered.php')
        ->toBeOrdered();
});

it('fails', function (string $file): void {
    expect($file)
        ->toBeOrdered();
})->with([
    'tests/Fixtures/alphaOrder/arrayNotOrdered.php',
    'tests/Fixtures/text/arrayNotOrdered.stub',
])->throws(ExpectationFailedException::class);

it('fails with not', function (string $file): void {
    expect($file)->not->toBeOrdered();
})->with([
    'tests/Fixtures/alphaOrder/arrayOrdered.php',
    'tests/Fixtures/text/arrayOrdered.stub',
])->throws(ExpectationFailedException::class);

it('fails when not all nested arrays content is ordered', function (): void {
    expect('tests/Fixtures/alphaOrder/nestedArrayNotOrdered.php')
        ->toBeOrdered();
})->throws(ExpectationFailedException::class, 'Your data is not ordered: pest <=> inSide');

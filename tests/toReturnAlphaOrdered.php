<?php

use PHPUnit\Framework\ExpectationFailedException;

it('passes', function (): void {
    expect('tests/Fixtures/alphaOrder/arrayOrdered.php')
        ->toBeOrdered();
});

it('passes with not', function (): void {
    expect('tests/Fixtures/alphaOrder/arrayNotOrdered.php')
        ->not->toBeOrdered();
});

it('passes when all nested arrays content is ordered', function (): void {
    expect('tests/Fixtures/alphaOrder/nestedArrayOrdered.php')
        ->toBeOrdered();
});

it('fails', function (): void {
    expect('tests/Fixtures/alphaOrder/arrayNotOrdered.php')
        ->toBeOrdered();
})->throws(ExpectationFailedException::class);

it('fails with not', function (): void {
    expect('tests/Fixtures/alphaOrder/arrayOrdered.php')
        ->not->toBeOrdered();
})->throws(ExpectationFailedException::class);

it('fails when not all nested arrays content is ordered', function (): void {
    expect('tests/Fixtures/alphaOrder/nestedArrayNotOrdered.php')
        ->toBeOrdered();
})->throws(ExpectationFailedException::class, 'Your data is not ordered: pest <=> inSide');

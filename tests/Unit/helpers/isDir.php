<?php

uses()->group('helpers');

it('returns true when is dir', function (): void {
    expect(isDir('tests/Fixtures'))->toBeTrue();
});

it('returns false when is not dir', function (): void {
    expect(isDir('tests/Fixtures/returnsArrayOnlyLowercase.php'))->toBeFalse();
});

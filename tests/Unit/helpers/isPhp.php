<?php

uses()->group('helpers');

it('returns true when is php file', function (): void {
    expect(isPhp('file.php'))->toBeTrue();
});

it('returns false when is not php file', function (): void {
    expect(isPhp('file.js'))->toBeFalse();
});

it('returns false when is dir', function (): void {
    expect(isPhp('directory'))->toBeFalse();
});

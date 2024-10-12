<?php

uses()->group('helpers');

it('returns true when is dir', function (): void {
    expect(isDir('directory'))->toBeTrue();
});

it('returns false when is not dir', function (): void {
    expect(isDir('file.php'))->toBeFalse();
});

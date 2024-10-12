<?php

uses()->group('helpers');

it('returns true when is dir', function (): void {
    expect(isDirOrPhp('directory'))->toBeTrue();
});

it('returns false when is php file', function (): void {
    expect(isDirOrPhp('file.php'))->toBeTrue();
});

it('returns false when is not php file', function (): void {
    expect(isDirOrPhp('file.js'))->toBeFalse();
});

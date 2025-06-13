<?php

uses()->group('helpers');

it('returns true when is dir', function (): void {
    expect(isDirOrSupportedFile('directory'))->toBeTrue();
});

it('returns false when is supported file', function (string $file): void {
    expect(isDirOrSupportedFile($file))->toBeTrue();
})->with(['file.php', 'file.txt', 'file.stub']);

it('returns false when is not supported file', function (): void {
    expect(isDirOrSupportedFile('file.js'))->toBeFalse();
});

<?php

uses()->group('helpers');

it('returns true when is text file', function (string $file): void {
    expect(isText($file))->toBeTrue();
})->with(['file.txt', 'file.stub']);

it('returns false when is not text file', function (): void {
    expect(isText('file.js'))->toBeFalse();
});

it('returns false when is dir', function (): void {
    expect(isText('directory'))->toBeFalse();
});

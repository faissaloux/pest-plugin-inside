<?php

uses()->group('helpers');

it('gets all supported files in directory and subdirectories', function (): void {
    $files = getFilesIn('tests/Fixtures');

    expect($files)->toBeArray()->toHaveCount(29);
});

it('gets all direct supported files in directory', function (): void {
    $files = getFilesIn('tests/Fixtures', depth: 0);

    expect($files)->toBeArray()->toHaveCount(11);
});

it('gets all supported files in directory depth 1', function (): void {
    $files = getFilesIn('tests/Fixtures', depth: 1);

    expect($files)->toBeArray()->toHaveCount(27);
});

it('gets all supported files in directory and subdirectories on negative depth', function (): void {
    $files = getFilesIn('tests/Fixtures', depth: -4);

    expect($files)->toBeArray()->toHaveCount(29);
});

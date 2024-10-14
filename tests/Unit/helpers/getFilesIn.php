<?php

uses()->group('helpers');

it('gets all php files in directory and subdirectories', function (): void {
    $files = getFilesIn('tests/Fixtures');

    expect($files)->toBeArray()->toHaveCount(12);
});

it('gets all direct php files in directory', function (): void {
    $files = getFilesIn('tests/Fixtures', depth: 0);

    expect($files)->toBeArray()->toHaveCount(5);
});

it('gets all php files in directory depth 1', function (): void {
    $files = getFilesIn('tests/Fixtures', depth: 1);

    expect($files)->toBeArray()->toHaveCount(10);
});

it('gets all php files in directory and subdirectories on negative depth', function (): void {
    $files = getFilesIn('tests/Fixtures', depth: -4);

    expect($files)->toBeArray()->toHaveCount(12);
});

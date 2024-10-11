<?php

function isDirOrPhp(string $maybeFile): bool
{
    return isDir($maybeFile) || isPhp($maybeFile);
}

function isDir(string $maybeDir): bool
{
    return ! str_contains($maybeDir, '.');
}

function isPhp(string $file): bool
{
    $exploded = explode('.', $file);

    return end($exploded) === 'php';
}

/**
 * @return array<string>
 */
function getFilesIn(string $directory, ?int $depth = null): array
{
    $allFiles = [];

    if ($files = scandir($directory)) {
        $files = array_diff($files, ['.', '..']);
        $files = array_filter($files, 'isDirOrPhp');

        foreach ($files as $file) {
            if (isDir($file)) {
                if (is_null($depth) || $depth > 0) {
                    $allFiles = array_merge(getFilesIn($directory.DIRECTORY_SEPARATOR.$file, is_null($depth) ? $depth : $depth - 1), $allFiles);
                }
            } else {
                $allFiles[] = $directory.DIRECTORY_SEPARATOR.$file;
            }
        }

        return $allFiles;
    }

    return [];
}

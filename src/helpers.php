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
function getFilesIn(string $directory, int $depth = -1): array
{
    $allFiles = [];

    if ($files = scandir($directory)) {
        $files = array_diff($files, ['.', '..']);
        $files = array_filter($files, 'isDirOrPhp');

        foreach ($files as $file) {
            if (isDir($file)) {
                if ($depth !== 0) {
                    $deeperFiles = getFilesIn($directory.DIRECTORY_SEPARATOR.$file, $depth < 0 ? $depth : $depth - 1);
                    $allFiles = array_merge($deeperFiles, $allFiles);
                }
            } else {
                $allFiles[] = $directory.DIRECTORY_SEPARATOR.$file;
            }
        }
    }

    return $allFiles;
}

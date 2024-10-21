<?php

declare(strict_types=1);

namespace Faissaloux\PestInside;

trait Investigator
{
    /**
     * @param array<string> $array
     * 
     * @return array<string>
     */
    private function lowercasesIn(array $array): array
    {
        $notLowerCase = [];

        foreach ($array as $word) {
            if ($word === '') {
                continue;
            }

            if (! ctype_lower(preg_replace('/[^A-Za-z]/', '', $word))) {
                array_push($notLowerCase, $word);
            }
        }

        return $notLowerCase;
    }

    /**
     * @param array<string> $array
     * 
     * @return array<string>
     */
    private function duplicatesIn(array $array): array
    {
        return array_diff_assoc($array, array_unique($array));
    }

    /**
     * @param array<string> $array
     * 
     * @return array<string>
     */
    private function singleWordsIn(array $array): array
    {
        return array_filter($array, fn (string $word): bool => str_contains(trim($word), ' '));
    }
}

<?php

declare(strict_types=1);

namespace Faissaloux\PestInside;

trait Investigator
{
    /**
     * @param  array<string|array<string>>  $array
     * @return array<string>
     */
    private function lowercasesIn(array $array): array
    {
        $unwanted = [];

        foreach ($array as $word) {
            if ($word === '') {
                continue;
            }

            if (is_array($word)) {
                array_push($unwanted, ...$this->lowercasesIn($word));
                continue;
            }

            if (! ctype_lower(preg_replace('/[^A-Za-z]/', '', $word))) {
                $unwanted[] = $word;
            }
        }

        return $unwanted;
    }

    /**
     * @param  array<string>  $array
     * @return array<string>
     */
    private function duplicatesIn(array $array): array
    {
        return array_diff_assoc($array, array_unique($array));
    }

    /**
     * @param  array<string>  $array
     * @return array<string>
     */
    private function singleWordsIn(array $array): array
    {
        return array_filter($array, fn (string $word): bool => str_contains(trim($word), ' '));
    }
}

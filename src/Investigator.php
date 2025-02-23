<?php

declare(strict_types=1);

namespace Faissaloux\PestInside;

/**
 * @internal
 */
trait Investigator
{
    /**
     * @param  array<string|array<string>>  $array
     * @return array<string>
     */
    private function notLowercasesIn(array $array): array
    {
        $unwanted = [];

        foreach ($array as $word) {
            if (is_array($word)) {
                array_push($unwanted, ...$this->notLowercasesIn($word));

                continue;
            }

            $clean = preg_replace('/[^A-Za-z]/', '', $word);

            if ($clean !== '' && ! ctype_lower($clean)) {
                $unwanted[] = $word;
            }
        }

        return $unwanted;
    }

    /**
     * @param  array<string|array<string>>  $array
     * @return array<string>
     */
    private function duplicatesIn(array $array): array
    {
        $unwanted = [];
        $unique = [];

        foreach ($array as $word) {
            if (is_array($word)) {
                array_push($unwanted, ...$this->duplicatesIn($word));

                continue;
            }

            if (! in_array($word, $unique)) {
                $unique[] = $word;
            } else {
                $unwanted[] = $word;
            }
        }

        return $unwanted;
    }

    /**
     * @param  array<string|array<string>>  $array
     * @return array<string>
     */
    private function multipleWordsIn(array $array): array
    {
        $unwanted = [];

        foreach ($array as $word) {
            if (is_array($word)) {
                array_push($unwanted, ...$this->multipleWordsIn($word));

                continue;
            }

            if (str_contains(trim((string) $word), ' ')) {
                $unwanted[] = $word;
            }
        }

        return $unwanted;
    }

    /**
     * @param  array<string|array<string>>  $array
     * @return array<string>
     */
    private function dataNotOrderedIn(array $array): array
    {
        if (count($array) < 2) {
            return [];
        }

        $unwanted = [];
        $lastWord = $array[0];

        foreach ($array as $key => $value) {
            if ($key === 0) {
                continue;
            }

            $currentWord = $value;
            if (is_array($currentWord) && is_string($lastWord)) {
                if ($lastWord > $key) {
                    $unwanted[] = "$lastWord <=> $key";
                }
                $lastWord = $key;

                array_push($unwanted, ...$this->dataNotOrderedIn($currentWord));

                continue;
            }

            if (is_string($currentWord) && is_string($lastWord) && $lastWord > $currentWord) {
                $unwanted[] = "$lastWord <=> $currentWord";
            }

            $lastWord = $currentWord;
        }

        return $unwanted;
    }
}

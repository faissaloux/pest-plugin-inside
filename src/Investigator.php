<?php

declare(strict_types=1);

namespace Faissaloux\PestInside;

use Faissaloux\PestInside\Contracts\Content;

/**
 * @internal
 */
trait Investigator
{
    /**
     * @param  Content|array<int|string, string|array<string, string>>  $content
     * @return array<string>
     */
    private function notLowercasesIn(Content|array $content): array
    {
        $unwanted = [];

        foreach ($content as $word) {
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
     * @param  Content|array<int|string, string|array<string, string>>  $content
     * @return array<string>
     */
    private function notUppercasesIn(Content|array $content): array
    {
        $unwanted = [];

        foreach ($content as $word) {
            if (is_array($word)) {
                array_push($unwanted, ...$this->notUppercasesIn($word));

                continue;
            }

            $clean = preg_replace('/[^A-Za-z]/', '', $word);

            if ($clean !== '' && ! ctype_upper($clean)) {
                $unwanted[] = $word;
            }
        }

        return $unwanted;
    }

    /**
     * @param  Content|array<int|string, string|array<string, string>>  $content
     * @return array<string>
     */
    private function duplicatesIn(Content|array $content): array
    {
        $unwanted = [];
        $unique = [];

        foreach ($content as $word) {
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
     * @param  Content|array<int|string, string|array<string, string>>  $content
     * @return array<string>
     */
    private function multipleWordsIn(Content|array $content): array
    {
        $unwanted = [];

        foreach ($content as $word) {
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
     * @param  Content|array<int|string, string|array<string, string>>  $content
     * @return array<string>
     */
    private function dataNotOrderedIn(Content|array $content): array
    {
        if (count($content) < 2) {
            return [];
        }

        $unwanted = [];
        $lastWord = $content[0];

        foreach ($content as $key => $value) {
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

    /**
     * @param  Content|array<int|string, string|array<string, string>>  $content
     * @return array<string>
     */
    private function notStringsIn(Content|array $content): array
    {
        if ($content instanceof Content && ($extension = $content->getExtension()) !== 'php') {
            throw new NotSupported("toReturnStrings is not supported on $extension files.");
        }

        $unwanted = [];

        foreach ($content as $word) {
            if (is_array($word)) {
                array_push($unwanted, ...$this->notStringsIn($word));

                continue;
            }

            if (! is_string($word)) {
                $unwanted[] = $word;
            }
        }

        return $unwanted;
    }
}

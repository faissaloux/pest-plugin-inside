<?php

declare(strict_types=1);

namespace Faissaloux\PestInside;

use Faissaloux\PestInside\Investigator;

final class Expectation extends Inside
{
    use Investigator;

    public function toReturnLowercase(int $depth = -1): void
    {
        $this->applyOnDirectory(
            $depth,
            fn (array $content): array => $this->lowercasesIn($content),
            'Not lowercase detected'
        );
    }

    public function toReturnUnique(int $depth = -1): void
    {
        $this->applyOnDirectory(
            $depth,
            fn (array $content): array => $this->duplicatesIn($content),
            'Duplicates detected'
        );
    }

    public function toReturnSingleWords(int $depth = -1): void
    {
        $this->applyOnDirectory(
            $depth,
            fn (array $content): array => $this->singleWordsIn($content),
            'Not single words detected'
        );
    }
}

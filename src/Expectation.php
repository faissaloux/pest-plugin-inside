<?php

declare(strict_types=1);

namespace Faissaloux\PestInside;

final class Expectation extends Inside
{
    use Investigator;

    public function toReturnLowercase(int $depth = -1): void
    {
        $this->applyOnDirectory(
            $depth,
            fn (array $content): array => $this->notLowercasesIn($content),
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
            fn (array $content): array => $this->multipleWordsIn($content),
            'Not single words detected'
        );
    }

    public function toBeOrdered(int $depth = -1): void
    {
        $this->applyOnDirectory(
            $depth,
            fn (array $content): array => $this->dataNotOrderedIn($content),
            'Your data is not ordered'
        );
    }

    public function toReturnStrings(int $depth = -1): void
    {
        $this->applyOnDirectory(
            $depth,
            fn (array $content): array => $this->notStringsIn($content),
            'Not string detected'
        );
    }
}

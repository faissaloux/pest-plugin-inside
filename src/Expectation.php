<?php

declare(strict_types=1);

namespace Faissaloux\PestInside;

use Faissaloux\PestInside\Contracts\Content;

final class Expectation extends Inside
{
    use Investigator;

    public function toReturnLowercase(int $depth = -1): void
    {
        $this->applyOnDirectory(
            $depth,
            fn (Content $content): array => $this->notLowercasesIn($content),
            'Not lowercase detected'
        );
    }

    public function toReturnUppercase(int $depth = -1): void
    {
        $this->applyOnDirectory(
            $depth,
            fn (Content $content): array => $this->notUppercasesIn($content),
            'Not uppercase detected'
        );
    }

    public function toReturnUnique(int $depth = -1): void
    {
        $this->applyOnDirectory(
            $depth,
            fn (Content $content): array => $this->duplicatesIn($content),
            'Duplicates detected'
        );
    }

    public function toReturnSingleWords(int $depth = -1): void
    {
        $this->applyOnDirectory(
            $depth,
            fn (Content $content): array => $this->multipleWordsIn($content),
            'Not single words detected'
        );
    }

    public function toBeOrdered(int $depth = -1): void
    {
        $this->applyOnDirectory(
            $depth,
            fn (Content $content): array => $this->dataNotOrderedIn($content),
            'Your data is not ordered'
        );
    }

    public function toReturnStrings(int $depth = -1): void
    {
        $this->applyOnDirectory(
            $depth,
            fn (Content $content): array => $this->notStringsIn($content),
            'Not string detected'
        );
    }
}

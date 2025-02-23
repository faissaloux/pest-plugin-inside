<?php

declare(strict_types=1);

use Faissaloux\PestInside\Expectation;
use Pest\Expectation as PestExpectation;

$expectations = get_class_methods(Expectation::class);
$expectations = array_filter($expectations, fn ($function): bool => str_starts_with($function, 'toReturn') || str_starts_with($function, 'toBe'));

foreach ($expectations as $expectation) {
    expect()->extend(
        $expectation,
        function (int $depth = -1) use ($expectation): PestExpectation {
            if (is_callable($callback = [new Expectation($this->value), $expectation])) {
                call_user_func($callback, ...func_get_args());
            }

            return $this;
        }
    );
}

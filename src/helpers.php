<?php

function isPhp(string $file): bool
{
    $exploded = explode(".", $file);

    return end($exploded) === "php";
}

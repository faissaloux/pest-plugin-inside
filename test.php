<?php

$array = [
    '',
    'f@issA!oux',
    'pest',
    'plugin',
    'inside',
    'lowercase',
    'lower',
    'case',
];

sort($array);

// array(8) {
//     [0]=>
//     string(0) ""
//     [1]=>
//     string(4) "case"
//     [2]=>
//     string(10) "f@issA!oux"
//     [3]=>
//     string(6) "inside"
//     [4]=>
//     string(5) "lower"
//     [5]=>
//     string(9) "lowercase"
//     [6]=>
//     string(4) "pest"
//     [7]=>
//     string(6) "plugin"
//   }
var_dump($array);

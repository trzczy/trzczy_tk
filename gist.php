<?php
$word = '';
$ar = ['a','b','c'];
echo "*** array_walk ***\nreturns: ";
var_dump(array_walk(
    $ar,
    function($k) use (&$word) {
        $word .= $k;
        return $word;
    }
));
echo "uses \$word: ";
var_dump($word);
echo "** /array_walk ***\n\n\n";
$word = '';

echo "*** array_map ***\nreturns: ";
var_dump(array_map(
    function($k) use (&$word) {
        $word .= $k;
        return $word;
    },
    ['a','b','c']
));
echo "uses \$word: ";
var_dump($word);
echo "** /array_map ***";
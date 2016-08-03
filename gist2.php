<?php
$input['links']["link"] = ["onet.pl", "wp.pl"];
$input['links']["title"] = ["Link 1", "Link 2"];

function rebuildArray($input)
{
    foreach ($input['links'] as $key => $value) {
        $index = 0;
        foreach ($value as $value2) {
            $arr2[$index++][$key] = $value2;
        }
    }
    $output['links'] = $arr2;
    return $output;
}

var_dump(rebuildArray($input));
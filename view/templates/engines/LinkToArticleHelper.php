<?php

namespace Trzczy\Login\View;

trait LinkToArticleHelper
{
//option 3
    function htmlTag($htmlTag, $open = true)
    {
        return '<' . ($open ? '' : '/') . "$htmlTag>";
    }

//option4
    function htmlTitleAttributeString($title)
    {
        return "title = 'Link do $title' rel = 'bookmark' ";
    }

    function option($int, $parametersArray, $title, $open = true) //todo remove this function, add triary condition to check if the option exists
    {
        if (isset($parametersArray[$int]) AND $parametersArray[$int]) {
            switch ($int) {
                case 3:
                    return '<' . ($open ? '' : '/') . $parametersArray[3] . '>';
                    break;
                case 4:
                    return "title = 'Link do {$title}' rel = 'bookmark' ";
                    break;
                default:
                    return $parametersArray[$int];
                    break;
            }
        } else {
            return '';
        }
    }

}

/*
articleIndex(0)/aClass(1)/visuallyHidden(2)/innerTag(3)/outOfMenu(4)
*/
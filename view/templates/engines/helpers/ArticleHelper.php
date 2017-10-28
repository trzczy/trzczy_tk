<?php
namespace Trzczy\Login\View;

/**
 * Created by PhpStorm.
 * User: master
 * Date: 2016-08-24
 * Time: 16:38
 */
trait ArticleHelper
{

//    function komentarze($number)
//    {
//        $r1 = $number % 100;
//        if ($r1 == 1 && $number < 100) {
//            $p = 'komentarz';
//        } else {
//            $r2 = $r1 % 10;
//            if (($r2 > 1 && $r2 < 5) && ($r1 < 12 || $r1 > 14)) {
//                $p = 'komentarze';
//            } else {
//                $p = 'komentarzy';
//            }
//        }
//        return $p;
//    }

    function komentarze($number)
    {
        $r1 = $number % 100;
        if ($r1 == 1 && $number < 100) {
            $p = 'comment';
        } else {
            $r2 = $r1 % 10;
            if (($r2 > 1 && $r2 < 5) && ($r1 < 12 || $r1 > 14)) {
                $p = 'comments';
            } else {
                $p = 'comments';
            }
        }
        return $p;
    }

}
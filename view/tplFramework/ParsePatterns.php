<?php
namespace Trzczy\Frameworks\Tpl;

interface ParsePatterns
{
    const TOTAL = ['pattern'=>'/{{(?<inner>.*?)}}/s', 'flag'=>false];
    const BODY = ['pattern'=>'/<body|(?!^)\G(.*?){{(?<inner>.*?)}}(?=.*<\/body>)/s', 'flag'=>"PREG_PATTERN_ORDER"];
    const NOBODY = ['pattern'=>'/(.*?){{(?<inner>.*?)}}(?=.*<body)/s', 'flag'=>"PREG_PATTERN_ORDER"];
}

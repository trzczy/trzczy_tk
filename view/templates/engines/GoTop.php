<?php
namespace Trzczy\Login\View;


use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class GoTop extends Engine implements EngineInterface
{
    protected $data;
    protected $parametersArray;

    function getResult()
    {
        $code = "
                <span>{{goTop2}}</span>
";
        return $code;
    }
}

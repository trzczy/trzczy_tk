<?php
namespace Trzczy\Login\View;

    use Trzczy\Frameworks\Tpl\Engine;
    use Trzczy\Frameworks\Tpl\EngineInterface;

class Close extends Engine implements EngineInterface
{
    protected $data;
//    protected $parametersArray;

    /**
     * @return string
     */
    function getResult()
    {
        $referrer = $this->data['referrer']??'""';
        return "<a class = 'close' href = $referrer>&#x2715;</a>";
    }
}




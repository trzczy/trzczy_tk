<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class Footer extends Engine implements EngineInterface
{
    protected $data;
    protected $parametersArray;

    /**
     * @return string
     */
    function getResult()
    {
        $class = 'footer';
        if (!empty($this->parametersArray[0])) {
            $class .= ' ' . (string)$this->parametersArray[0];
        }
        return '<footer class="' . $class . '"><p>&copy; trzczy {{footer2}} 2017</p></footer>';
    }
}
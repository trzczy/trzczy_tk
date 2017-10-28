<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class Style extends Engine implements EngineInterface
{
    protected $data;
    protected $parametersArray;

    /**
     * @return string
     */
    function getResult()
    {
        $page = (isset($this->data['page']))
            ?
            $this->data['page']
            :
            'style';
        return "
    <link rel=\"stylesheet\" type=\"text/css\" href=\"view/$page.css\">
";
    }
}
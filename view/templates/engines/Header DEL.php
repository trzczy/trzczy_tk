<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class DEL extends Engine implements EngineInterface
{
    protected $data;
    protected $parametersArray;

    /**
     * @return string
     */
    function getResult() {
        $class = (!empty($this->parametersArray[0]))
            ?
            " {$this->parametersArray[0]}"
            :
            '';
        return "
<header class='header$class' role='banner'>
    <div class='header-top'>
        {{logo}}
        {{motto}}
    </div><!-- .header-top-->
</header>
";
    }
}
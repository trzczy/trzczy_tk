<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class FirstArticle extends Engine implements EngineInterface
{
    protected $data;
    protected $parametersArray;

    /**
     * @return string
     */
    function getResult()
    {
        $ctrl = (!empty($this->data['ctrl']))
            ?
            $this->data['ctrl']
            :
            ''
        ;
        return "
<!DOCTYPE html>
<html lang=\"pl\">
{{head}}
<body id='start' class='$ctrl'>
{{topBar}}
{{header}}
<div class='container'>
    <div class='wrapper'>
        {{mainArticle}}
        {{aside}}
    </div><!--.wrapper-->
    {{footer/last}}
</div>
{{goTop/param}}
</body>
</html>
";
    }
}
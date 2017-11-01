<?php

namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class Comments extends Engine implements EngineInterface
{
    protected $data;
    protected $parametersArray;

    /**
     * @return string
     */
    function getResult()
    {
        $view_id = (int)$this->parametersArray[0];
        $db_id = $this->data['articles'][$view_id]->article_id;


        return "
▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛▬⬛
\$view_id = $view_id
\$db_id = $db_id
◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛◼⬛

<input class='commenting display-toggle' id='display-toggle$view_id' type=checkbox>
<label class='commenting display-button' for='display-toggle$view_id'><span>Commenting ▼</span></label>
<label class='commenting hide-button' for='display-toggle$view_id'><span>Commenting ▲</span></label>
<div class='hidden-content'>
<div class='fb-comments' data-href='http://trzczy.tk/blog#article$db_id' data-width='888' data-numposts='5'></div></div>";
    }
}

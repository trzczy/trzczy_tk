<?php
namespace Trzczy\Login\View;

use DisqusAPI;
use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class Articles extends Engine implements EngineInterface
{
    protected $code;
    protected $data;
    protected $parametersArray;


    /**
     * @return string
     */
    function getResult()
    {
        $articlesArray = $this->data["articles"];
        $code = '';
        $ct = 0;
        if (isset($this->parametersArray[0]) AND 'menu' === $this->parametersArray[0]) {
            foreach ($articlesArray as $article) {
                $code .= "
        <li>
            <!-- {{linkToArticle/articleIndex(0)/aClass(1)/visuallyHidden(2)/innerTag(3)/outOfMenu(4)}} -->
            {{linkToArticle/" . $ct++ . "/link-menu/0/0/0}}
        </li>
";
            }
        } else {
            $single = '';
            if (isset($this->parametersArray[1]) AND 'single' === $this->parametersArray[1]) {
                $single = (isset($this->parametersArray[1]) and ('single' === $this->parametersArray[1])) ? ('{{test}}') : '';
            }
            $singleParameter = (!empty($single)) ? '/single' : '';




            foreach ($articlesArray as $article) {
                $code .= "{{article/" . $ct++ . "$singleParameter}}" . $single;
            }
        }
        return $code;
    }
}

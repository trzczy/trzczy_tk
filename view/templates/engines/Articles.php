<?php
namespace Trzczy\Login\View;

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
//        {{linkToArticle/articleIndex(0)/aClass(1)/visuallyHidden(2)/innerTag(3)/outOfMenu(4)}}
        if (isset($this->parametersArray[0]) AND 'menu' === $this->parametersArray[0]) {
            foreach ($articlesArray as $article) {
                $code .= "
        <li>
            {{linkToArticle/" . $ct++ . "/link-menu/0/0/0}}
        </li>
";
            }
        } else {
            $single = (isset($this->parametersArray[1]) and ('single' === $this->parametersArray[1])) ? ('{{test}}') : '';
            $singleParameter = $single ? '/single' : '';
            foreach ($articlesArray as $article) {
                $code .= "{{article/" . $ct++ . "$singleParameter}}" . $single;
            }
        }
        return $code;
    }
}

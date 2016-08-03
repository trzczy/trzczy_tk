<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class ArticleBody extends Engine implements EngineInterface
{
    protected $data;
    protected $parametersArray;

    /**
     * @return string
     */
    function getResult()
    {
        $articlesArray = $this->data["articles"];
        $ct = (int)$this->parametersArray[0];
        $article = $articlesArray[$ct];



        return "<div itemprop='articleBody'>
{$this->highlight(mb_convert_encoding($article->body, 'HTML-ENTITIES', "UTF-8"))}
</div>
";
    }
}

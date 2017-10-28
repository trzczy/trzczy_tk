<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class LinkToArticle extends Engine implements EngineInterface {
    use LinkToArticleHelper;

    protected $code;
    protected $data;
    protected $parametersArray;
    private $articleIdPrefix = 'article';

    /**
     * @return string
     *
     * {{linkToArticle/articleIndex/aClass/visuallyHidden/innerTag/menu}}
     */
    function getResult()
    {
//        $this->parametersArray = ['a0', 'a1', 'a2', 'a3', 'a4'];
        /*
         * linkToArticle/articleIndex(0)/aClass(1)/visuallyHidden(2)/innerTag(3)/outOfMenu(4)
         */
        foreach (range(1, 4) as $index) {
            $val = ($this->parametersArray[$index]??''??$this->parametersArray[$index]);
            $this->parametersArray[$index] = ($val === '0') ? '' : $val;
        }
        $htmlCloseTag = $htmlTag = '';
        if ($this->parametersArray[3]) {
            $htmlTag =
                $this->htmlTag($this->parametersArray[3]);
            $htmlCloseTag =
                $this->htmlTag($this->parametersArray[3], false);
        }

        $articlesArray = $this->data["articles"];
        $article = $articlesArray[(int)($this->parametersArray[0])];
        $htmlId = $this->articleIdPrefix . $article->article_id;

        $htmlTitleAttributeString = '';
        if ($this->parametersArray[4]) {
            $htmlTitleAttributeString =
                $this->htmlTitleAttributeString(
                    $article->title);
        }
        $code = "
            <a $htmlTitleAttributeString" . "class = '" . $this->parametersArray[1] .
            (($this->parametersArray[2]) ? ' visually-hidden' : '') .
            "' href = '#$htmlId'>$htmlTag{$article->title}$htmlCloseTag</a>
";
        return $code;
    }
}

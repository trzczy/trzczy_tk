<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class LinkToArticle extends Engine implements EngineInterface
{
    protected $code;
    protected $data;
    protected $parametersArray;
    private $articleIdPrefix = 'article';
    private $article;

    /**
     * @return string
     *
     * {{linkToArticle/articleIndex/aClass/visuallyHidden/innerTag/menu}}
     */
    function getResult()
    {
        $articlesArray = $this->data["articles"];
        /*
         * {{linkToArticle/articleIndex(0)/aClass(1)/visuallyHidden(2)/innerTag(3)/outOfMenu(4)}}
         */
        $this->article = $articlesArray[(int)($this->option(0))];
        $code = "
            <a " . $this->option(4) . "class = '" . $this->option(1) . (($this->option(2)) ? ' visually-hidden' : '') . "' href = '#{$this->articleIdPrefix}{$this->article->article_id}'>{$this->option(3)}{$this->article->title}{$this->option(3, false)}</a>
";
        return $code;
    }

    /**
     * @param $int
     * @return string
     *
     * @usage $this->option(2);
     */
    function option($int, $open = true)
    {
        if (isset($this->parametersArray[$int])AND$this->parametersArray[$int]) {
            switch ($int) {
                case 3:
                    return (($int === 3) ? ('<' . ($open ? '' : '/')) : '') . $this->parametersArray[$int] . (($int === 3) ? '>' : '');
                    break;
                case 4:
                    return "title = 'Link do {$this->article->title}' rel = 'bookmark' ";
                    break;
                default:
                    return $this->parametersArray[$int];
                    break;
            }
        } else {
            return '';
        }
    }
}


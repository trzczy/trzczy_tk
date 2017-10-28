<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class ArticleHeader extends Engine implements EngineInterface
{
    protected $parametersArray;
    private $articleIdPrefix = 'article';


    /**
     * @return string
     */
    function getResult()
    {
        $article_id = (int)$this->parametersArray[0];
        $articleHtml_id = $this->articleIdPrefix . $article_id;


    switch ((int)$this->parametersArray[4]) {
        case 0:
            $localCtrl = 'article';
            break;
        case 1:
            $localCtrl = 'app';
            break;
    }

        return "
    <header>
        <h3><a href = " . (($this->data['ctrl']==='excerpts')?("'?ctrl=$localCtrl&id=$article_id'"):"'#$articleHtml_id'") . " rel='bookmark' title = 'Link do {$this->parametersArray[1]}' class = 'article-title'>{$this->parametersArray[1]}</a></h3>
        <p class = 'posted'>Posted on
             <a href = " . (($this->data['ctrl']==='excerpts')?("'?ctrl=$localCtrl&id=$article_id'"):"'#$articleHtml_id'") . " class = 'article-date'>
                <time datetime = " . date('c',
            strtotime($this->parametersArray[2])) . " itemprop='datePublished'>" . date('Y-m-d H:i',
            strtotime($this->parametersArray[2])) . "</time>
            </a>
            <span class = 'sep'> by </span>{$this->parametersArray[3]}
        </p>
    </header>";
    }
}


//$this->parametersArray[0]::articleId
//$this->parametersArray[1]::articleTitle
//$this->parametersArray[2]::articleCreated
//$this->parametersArray[3]::articleUserName

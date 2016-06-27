<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class ArticleHeader extends Engine implements EngineInterface
{
    protected $parametersArray;

    /**
     * @return string
     */
    function getResult()
    {
        return "
<header>
        <h3><a href = '#{$this->parametersArray[0]}' rel='bookmark' title = 'Link do {$this->parametersArray[1]}'>{$this->parametersArray[1]}</a></h3>
        <p class = 'posted'>Opublikowano
             <a href = '#{$this->parametersArray[0]}'>
                <time datetime = " . date('c', strtotime($this->parametersArray[2])) . " itemprop='datePublished'>" . date('Y-m-d H:i', strtotime($this->parametersArray[2])) . "</time>
            </a>
            <span class = 'sep'> przez </span>{$this->parametersArray[3]}
        </p>
    </header>";
    }
}


//$this->parametersArray[0]::articleId
//$this->parametersArray[1]::articleTitle
//$this->parametersArray[2]::articleCreated
//$this->parametersArray[3]::articleUserName

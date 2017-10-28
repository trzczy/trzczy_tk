<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class Excerpt extends Engine implements EngineInterface
{
    protected $data;
    protected $parametersArray;
    private $articleIdPrefix = 'article';

    /**
     * @return string
     */
    function getResult()
    {
        $articlesArray = $this->data["articles"];
        $ct = (int)$this->parametersArray[0];
        $article = $articlesArray[$ct];
        return "
<article id = '{$this->articleIdPrefix}{$article->article_id}' class='' itemprop='blogPost' itemscope='' itemtype='http://schema.org/BlogPosting'>
    {{articleHeader/{$article->article_id}/{$article->title}/{$article->created}/{$article->username}/{$article->sort}}}
    <div itemprop='articleBody'>{{articleBody/" . $ct . "}}</div>
    <a class = 'more' href = '?ctrl={$this->articleIdPrefix}&id={$article->article_id}'>View full post</a>
    <footer>
        {{tagSection/" . $ct . "}}
    </footer>
</article>
";


    }
}

<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class Article extends Engine implements EngineInterface
{
    use ArticleHelper;
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
        $single = (isset($this->parametersArray[1])) ? $this->parametersArray[1] : false;

        $article = $articlesArray[$ct];
        return "
<article id = '{$this->articleIdPrefix}{$article->article_id}'
    class='' itemprop='blogPost' itemscope='' itemtype='http://schema.org/BlogPosting'>
    {{articleHeader/{$article->article_id}/{$article->title}/{$article->created}/{$article->username}/{$article->sort}}}
    {{articleBody/" . $ct . "}}
    <footer>
       {{tagSection/" . $ct . "}}
" . (!$single ? "<a class = 'comment-info' title = 'Link do komentarzy " . $article->title .
                "' href = '?ctrl={$this->data['commentLabel']}&id={$article->article_id}&anchor#disqus_thread'>" . (
            ($article->comments_number)
                ?
                ($article->comments_number . " {$this->komentarze($article->comments_number)}")
                :
                'Comment'
            ) . "</a>" : '') . "
    </footer>" .
        (!$single
            ?
            "
            <a style = 'top: " . (int)($ct * 33 + 222) . "px' title = 'Link do " . $article->title .
                "' class = 'bullet' href = '#{$this->articleIdPrefix}{$article->article_id}' tabindex = '-1'>
                    <span class = 'visually-hidden'>" .
                $article->title . "</span></a>    
        "
            :
            ''
        ) . "
    {{comments/$ct++}}
    </article>
";
    }
}
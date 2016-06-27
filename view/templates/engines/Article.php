<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class Article extends Engine implements EngineInterface
{
    protected $data;
    protected $parametersArray;
    private $articleIdPrefix = 'article';


    function komentarze($number)
    {
        $r1=$number % 100;
        if ($r1 == 1 && $number < 100)
        {
            $p='komentarz';
        }
        else
        {
            $r2=$r1 % 10;
            if (($r2 > 1 && $r2 < 5) && ($r1 < 12 || $r1 > 14))
            {
                $p='komentatrze';
            }
            else
            {
                $p='komentarzy';
            }
        }
        return $p;
    }



    /**
     * @return string
     */
    function getResult()
    {
        $articlesArray = $this->data["articles"];
        $ct = (int)$this->parametersArray[0];
        $single = (isset($this->parametersArray[1])) ? $this->parametersArray[1] : false;

        $article = $articlesArray[$ct];
        if (!empty($article->tags)) {
            $tagsSection = "<section class = 'tags'>
			<h4 class='visually-hidden'>Tagi</h4>
            <ul>";
            foreach ($article->tags as $tag) {
                $tagsSection .= "
                <a href='?ctrlr=excerpts&felicia=43&tag=" . urlencode($tag) . "' rel='tag'><li>$tag</li></a>";
            }
            $tagsSection .= "
            </ul>
        </section>";
        }



        return "
<article id = '{$this->articleIdPrefix}{$article->article_id}' class='' itemprop='blogPost' itemscope='' itemtype='http://schema.org/BlogPosting'>
    {{articleHeader/{$this->articleIdPrefix}{$article->article_id}/{$article->title}/{$article->created}/{$article->username}}}
    {{articleBody/" . $ct . "}}
    <footer>
        $tagsSection
" . (!$single ? "<a class = 'beTheFirstToComment' title = 'Link do komentarzy " . $article->title . "' href = '/?ctrlr=article&id={$article->article_id}&anchor#disqus_thread'>" . (
            ($article->comments_number)
                ?
                ($article->comments_number . " {$this->komentarze($article->comments_number)}")
                :
                'Bądź pierwszym komentującym'
            ) . "</a>" : '') . "
    </footer>
    <a style = 'top: " . (int)($ct++ * 33) . "px' title = 'Link do " . $article->title . "' class = 'bullet' href = '#{$this->articleIdPrefix}{$article->article_id}' tabindex = '-1'><span class = 'visually-hidden'>" . $article->title . "</span></a>
</article>
";
    }
}


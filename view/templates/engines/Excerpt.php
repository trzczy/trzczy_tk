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

        if (!empty($article->tags)) {
            $tagsSection = "<section class = 'tags'>
			<h4 class='visually-hidden'>Tagi</h4>
            <ul>";
            foreach ($article->tags as $tag) {
                $tagsSection .= "
                <a href='?ctrlr=excerpts&felicia=43&tag=" . urlencode($tag) . "' rel='tag'" . (($this->data['tagName']===$tag)?'class = "active"':'') . "><li>$tag</li></a>";
            }
            $tagsSection .= "
            </ul>
        </section>";
        }
        return "
<article id = '{$this->articleIdPrefix}{$article->article_id}' class='' itemprop='blogPost' itemscope='' itemtype='http://schema.org/BlogPosting'>
    {{articleHeader/{$this->articleIdPrefix}{$article->article_id}/{$article->title}/{$article->created}/{$article->username}}}
    <div itemprop='articleBody'>{{articleBody/" . $ct . "}}</div>
    <a class = 'more' href = '/?ctrlr={$this->articleIdPrefix}&id={$article->article_id}'>Więcej</a>
    <footer>
        " . $tagsSection . "
    </footer>
</article>
";


    }
}

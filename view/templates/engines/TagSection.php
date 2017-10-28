<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class TagSection extends Engine implements EngineInterface
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
        if (!empty($article->tags)) {
            $tagsSection = "<section class = 'tags'>
			<h4 class='visually-hidden'>Tagi</h4>
            <ul>";
            foreach ($article->tags as $tag) {
                $tagsSection .= "
                <li><a href='?ctrl=excerpts&felicia=43&tag=" . urlencode($tag) . "' rel='tag'" . (isset($this->data['tagName'])AND(($this->data['tagName']===$tag)?'class = "active"':'')) . " class = 'tag'>$tag</a></li> ";
            }
            $tagsSection .= "
            </ul>
        </section>";
            return $tagsSection;
        }
        return '';
    }
}




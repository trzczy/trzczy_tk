<?php
namespace Mvc\Model\Domain;

class BlogDomain
{
    use ArticleDomainHelper;

    private $articles = [];
    function add(ArticleDomain $object)
    {
            $text = $this->cleanArticle($object->body);//$text
            $object->body = $this->replaceBracketsByCompareOperatorsEverywhereButInCodePresentation($text);

        $this->articles[] = $object;
    }

    /**
     * @return array
     */
    public function getArticles()
    {
        return $this->articles;
    }
}

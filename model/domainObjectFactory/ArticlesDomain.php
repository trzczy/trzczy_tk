<?php
namespace Mvc\Model\Domain;
class ArticlesDomain
{
    private $articles = [];

    function add(ArticleDomain $article)
    {
        $this->articles[] = $article;
    }

    /**
     * @return array
     */
    public function getArticles()
    {
        return $this->articles;
    }
}

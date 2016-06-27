<?php
namespace Mvc\Model\Mapper;
use Mvc\Model\Domain\ArticleDomain;
use Mvc\Model\Domain\ArticlesDomain;

class ArticlesDataMapper extends DataMapperFactory
{
    protected $dbhProvider;
    /**
     * Blog constructor.
     * @param $dbhProvider
     */
    public function __construct($dbhProvider)
    {
        $this->dbhProvider = $dbhProvider;
    }
    function fetch(ArticlesDomain $articles, $tag)
    {
        $dbhProvider = $this->dbhProvider;
        $sth = $dbhProvider()->prepare("
SELECT tag.description, article.title, article.author_id, article.created, article_body.body, article.article_id, users.username
FROM `tag`
JOIN `article_tag_map` ON article_tag_map.tag_id=tag.tag_id
JOIN `article_body` ON article_body.article_id=article_tag_map.article_id
JOIN `article` ON article.article_id=article_tag_map.article_id
JOIN `users` ON users.user_id=article.author_id
WHERE tag.`description`= '" . $tag . "' GROUP BY article.article_id");
        $sth->execute();
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);



        if (empty($result)) return;

        while ($articleData = array_shift($result)) {
            $articleObject = new ArticleDomain();
            $articleDomainVariables = get_object_vars($articleObject);
            foreach ($articleDomainVariables as $property => $value) {
                if(isset($articleData[$property]))
                    $articleObject->$property = $articleData[$property];
            }

            $articleId = $articleData['article_id'];
            $dbhProvider = $this->dbhProvider;
            $sth = $dbhProvider()->prepare("
SELECT t.`description` FROM `tag` t
JOIN `article_tag_map` a ON a.`tag_id`=t.`tag_id`
WHERE a.`article_id`=" . $articleId . " GROUP BY t.`tag_id`");
            $sth->execute();

            $articleObject->tags = array_map(function($arg) {return $arg['description'];}, $sth->fetchAll(\PDO::FETCH_ASSOC));
            $articles->add($articleObject);
        }
    }
}


//SELECT t.`description`, a.`title`
//FROM `tag` t
//JOIN `article_tag_map` m ON m.`tag_id`=t.`tag_id`
//JOIN `article_body` b ON b.`article_id`=m.`article_id`
//JOIN `article` a ON a.`article_id`=m.`article_id`
//WHERE t.`tag_id`= 1 GROUP BY a.`article_id`


//SELECT tag.description, article.title, article.author_id, article.created, article_body.body
//FROM `tag`
//JOIN `article_tag_map` ON article_tag_map.tag_id=tag.tag_id
//JOIN `article_body` ON article_body.article_id=article_tag_map.article_id
//JOIN `article` ON article.article_id=article_tag_map.article_id
//JOIN `users` ON users.user_id=article.author_id
//WHERE tag.`description`= 'tag3' GROUP BY article.article_id
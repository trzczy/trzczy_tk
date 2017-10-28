<?php
namespace Mvc\Model\Mapper;

use DisqusAPI;
use Mvc\Model\Domain\ArticleDomain;
use Mvc\Model\Domain\BlogDomain;

class BlogDataMapper extends DataMapperFactory
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

    function fetch(BlogDomain $blog, $tag = null, $sort = 0)
    {
        $dbhProvider = $this->dbhProvider;
        $query = "
            SELECT article.sort, article.article_id, article.title, article.created, users.username, article_body.body
            FROM `article`
            JOIN `article_body` ON article.article_id = article_body.article_id
            JOIN `users` ON article.author_id = users.user_id" . ($tag?"
            JOIN `article_tag_map` ON article.article_id = article_tag_map.article_id
            JOIN `tag` ON article_tag_map.tag_id = tag.tag_id
            WHERE tag.description='$tag'":'') . (($tag&&$sort)?' AND (':'') . (((!$tag)&$sort)?' WHERE ':'') . ($sort?$this->arrayToWhere($sort):'') . (($tag&&$sort)?')':'')
        ;

        $sth = $dbhProvider()->prepare($query);

        $sth->execute();
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($result)) return;


        require('./disqusapi/disqusapi.php');
        $disqus = new DisqusAPI('FHGYJCfJdDNxriIIBQ0dWKmiKYyexUMI69cHMm9n6wt3eiLWxUuIDjgqqXVmdtYn');
        $threads = $disqus->forums->listThreads(array('forum' => 'trzczytk'));


        while ($articleData = array_shift($result)) {
            $articleObject = new ArticleDomain();

            $articleDomainVariables = get_object_vars($articleObject);
            foreach ($articleDomainVariables as $property => $value) {
                if (isset($articleData[$property]))
                    $articleObject->$property = $articleData[$property];
            }

            $articleObject->comments_number = 0;
            $identifier = "article{$articleObject->article_id}";
            foreach ($threads as $threadObj) {
                if (in_array($identifier, $threadObj->identifiers)) {
                    $articleObject->comments_number = $threadObj->posts;
                    break;
                }
            }



            $articleId = $articleData['article_id'];
            $dbhProvider = $this->dbhProvider;
            $sth = $dbhProvider()->prepare("SELECT t.`description` FROM `tag` t JOIN `article_tag_map` a ON a.`tag_id`=t.`tag_id` WHERE a.`article_id`=" . $articleId . " GROUP BY t.`tag_id`");
            $sth->execute();

            $articleObject->tags = array_map(function ($arg) {
                    return $arg['description'];
                }, $sth->fetchAll(\PDO::FETCH_ASSOC)
            );
            $blog->add($articleObject);
        }


    }

    private function arrayToWhere($sort)
    {
        $separated = implode(" OR article.sort=", $sort);
        return "article.sort=" . $separated;
    }
}
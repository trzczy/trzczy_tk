<?php
namespace Mvc\Model\Mapper;

use Mvc\Model\Domain\ArticleDomain;
use Mvc\Model\Domain\BlogDomain;

class ArticleDataMapper extends DataMapperFactory
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
    function fetch(ArticleDomain $article, $id) {
        $dbhProvider = $this->dbhProvider;
        $sth = $dbhProvider()->prepare("SELECT * FROM `article` JOIN `article_body` ON article.article_id = article_body.article_id JOIN `users` ON article.author_id = users.user_id WHERE article.article_id = $id");
        $sth->execute();
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);


        //Debug info
        ?><span class='debugNfo'><h4>Debug info | title <?= '<span style = "color: green;">' . __FILE__ . '</span> ' . __LINE__ ?></h4><pre><?php
                //May repeat
                echo "\n\n";
                echo '';
                echo "\n\n";
                //may repeat end
                //May repeat 2
                var_dump($result);
                echo "\n";
                //may repeat 2 end
                ?></pre><h4>End</h4></span><?= "\n\n\n\n" ?><?php
        //Debug info end


        if (empty($result)) return;

        while ($articleData = array_shift($result)) {
            $articleVariables = get_object_vars($article);
            foreach ($articleVariables as $property => $value) {
                if(isset($articleData[$property]))
                    $article->$property = $articleData[$property];
            }

            $articleId = $articleData['article_id'];

            $sth = $dbhProvider()->prepare("SELECT t.`description` FROM `tag` t JOIN `article_tag_map` a ON a.`tag_id`=t.`tag_id` WHERE a.`article_id`=" . $articleId . " GROUP BY t.`tag_id`");
            $sth->execute();

            $article->tags = array_map(function($arg) {return $arg['description'];}, $sth->fetchAll(\PDO::FETCH_ASSOC));
        }
    }
}
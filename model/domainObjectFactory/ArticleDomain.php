<?php
namespace Mvc\Model\Domain;
class ArticleDomain
{
    public $article_id;
    public $title;
    public $created;
    public $username;
    public $body;
    public $tags = [];
    public $page_title = 'Give an unique title for the page';
    public $comments_number;

    public function __set($key, $value) {
        $this->$key = strip_tags($value);
    }

}

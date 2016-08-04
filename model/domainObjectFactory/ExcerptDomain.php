<?php
namespace Mvc\Model\Domain;

class ExcerptDomain
{
    public $article_id;
    public $title;
    public $created;
    public $username;
    public $body;
    public $tags = [];

    function __construct(ArticleDomain $object, $serialized)
    {
        $object->prepare();
        $object->trimToExcerpt(5225);

        $articleDomainVariables = get_object_vars($object);
        foreach ($articleDomainVariables as $property => $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
        unset($object);
    }
}


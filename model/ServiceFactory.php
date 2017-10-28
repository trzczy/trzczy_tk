<?php
namespace Mvc\Model;

class ServiceFactory
{
    private $dataMapperFactory;
    private $domainObjectFactory;
    private $blogData;
    private $articlesData;

    public function __construct($dataMapperFactory, $domainObjectFactory)
    {
        $this->dataMapperFactory = $dataMapperFactory;
        $this->domainObjectFactory = $domainObjectFactory;
    }

    public function getBlogData(array $sortList)
    {
        $mapper = $this->dataMapperFactory->build('blog', 'Mvc\\Model\\Mapper\\');
        $this->blogData = $this->domainObjectFactory->build('blog', 'Mvc\\Model\\Domain\\');
        $mapper->fetch($this->blogData, null, $sortList);
        return $this->blogData;
    }
//
//    public function getAppsData()
//    {
//        $mapper = $this->dataMapperFactory->build('apps', 'Mvc\\Model\\Mapper\\');
//        $this->blogData = $this->domainObjectFactory->build('blog', 'Mvc\\Model\\Domain\\');
//        $mapper->fetch($this->blogData);
//        return $this->blogData;
//    }

    //probably to remove
//    public function getTagData() {
//        $this->blogData = $this->getBlogData();
//        $excerptsArray = array_map(function ($articleDomainObject) {return $this->domainObjectFactory->build('excerpt', 'Mvc\\Model\\Domain\\', $articleDomainObject);}, $this->blogData->getArticles());
//        $tagResult = $this->domainObjectFactory->build('tagresult', 'Mvc\\Model\\Domain\\');
//        $tagResult->setExcerpts($excerptsArray);
//        return $tagResult;
//    }

    public function getArticleById($id)
    {
        $mapper = $this->dataMapperFactory->build('article', 'Mvc\\Model\\Mapper\\');
        $articleObject = $this->domainObjectFactory->build('article', 'Mvc\\Model\\Domain\\');

        $mapper->fetch($articleObject, $id);
        $text = $articleObject->cleanArticle($articleObject->body);//$text
        $articleObject->body = $articleObject->replaceBracketsByCompareOperatorsEverywhereButInCodePresentation($text);

        return $articleObject;
    }

    public function getExcerptsByTag($tag, $sortList)
    {
        $this->articlesData = $this->getArticlesDataByTag($tag, $sortList);
        $excerptsArray = array_map(
            function (
                $articleDomainObject
            ) {
                return $this->domainObjectFactory->build('excerpt', 'Mvc\\Model\\Domain\\', $articleDomainObject);
            },
            $this->articlesData->getArticles()
        );
        $tagResult = $this->domainObjectFactory->build('tagResult', 'Mvc\\Model\\Domain\\');
        $tagResult->setExcerpts($excerptsArray);
        return $tagResult;
    }

    public function getArticlesDataByTag($tag = '', $sortList)
    {
        $mapper = $this->dataMapperFactory->build('blog', 'Mvc\\Model\\Mapper\\');
        $this->articlesData = $this->domainObjectFactory->build('blog', 'Mvc\\Model\\Domain\\');
        $mapper->fetch($this->articlesData, $tag, $sortList);
        return $this->articlesData;
    }

    public function getReferrer()
    {
        return $_SERVER['HTTP_REFERER']??'';
    }

    public function setDefaultNamespace($string)
    {
    }
}

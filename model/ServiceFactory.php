<?php
namespace Mvc\Model;
class ServiceFactory
{
    private $dataMapperFactory;
    private $domainObjectFactory;
    private $blogData;
    private $articlesData;
    private $articleData;

    public function __construct($dataMapperFactory, $domainObjectFactory)
    {
        $this->dataMapperFactory = $dataMapperFactory;
        $this->domainObjectFactory = $domainObjectFactory;
    }

    public function getBlogData() {
        $mapper = $this->dataMapperFactory->build('blog', 'Mvc\\Model\\Mapper\\');
        $this->blogData = $this->domainObjectFactory->build('blog', 'Mvc\\Model\\Domain\\');
        $mapper->fetch($this->blogData);
        return $this->blogData;
    }

    public function getTagData() {
        $this->blogData = $this->getBlogData();
        $excerptsArray = array_map(function ($articleDomainObject) {return $this->domainObjectFactory->build('excerpt', 'Mvc\\Model\\Domain\\', $articleDomainObject);}, $this->blogData->getArticles());
        $tagResult = $this->domainObjectFactory->build('tagresult', 'Mvc\\Model\\Domain\\');
        $tagResult->setExcerpts($excerptsArray);
        return $tagResult;
    }

    public function getArticlesDataByTag($tag = '') {
        $mapper = $this->dataMapperFactory->build('articles', 'Mvc\\Model\\Mapper\\');
        $this->articlesData = $this->domainObjectFactory->build('articles', 'Mvc\\Model\\Domain\\');
        $mapper->fetch($this->articlesData, $tag);
        return $this->articlesData;
    }

    public function getArticleById($id) {
        $mapper = $this->dataMapperFactory->build('article', 'Mvc\\Model\\Mapper\\');
        $this->articleData = $this->domainObjectFactory->build('article', 'Mvc\\Model\\Domain\\');

        $mapper->fetch($this->articleData, $id);

        return $this->articleData;
    }

    public function getExcerptsByTag($tag) {
        $this->articlesData = $this->getArticlesDataByTag($tag);
        $excerptsArray = array_map(function ($articleDomainObject) {return $this->domainObjectFactory->build('excerpt', 'Mvc\\Model\\Domain\\', $articleDomainObject);}, $this->articlesData->getArticles());
        $tagResult = $this->domainObjectFactory->build('tagResult', 'Mvc\\Model\\Domain\\');
        $tagResult->setExcerpts($excerptsArray);
        return $tagResult;
    }

    public function setDefaultNamespace($string)
    {
    }
}

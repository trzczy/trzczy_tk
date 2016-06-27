<?php
namespace Trzczy\Login\Controller;

class ArticleController
{
    private $data;

    function __construct($view, $debugIsOn = false, $serviceFactory = null, $id)
    {



        $debug = new \stdClass;
        $debug->on = $debugIsOn;

        $this->data['debug'] = $debug;

        $this->data['siteTitle'] = 'Artykuły mojego bloga';
        $this->data['articles'][] = $serviceFactory->getArticleById($id);

        $view->render($this->data, 'articleFirst');
    }
}

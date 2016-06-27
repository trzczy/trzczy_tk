<?php
namespace Trzczy\Login\Controller;

class IndexController
{
    private $data;

    function __construct($view, $debugIsOn = false, $serviceFactory = null)
    {
        $debug = new \stdClass;
        $debug->on = $debugIsOn;

        $this->data['debug'] = $debug;

        $this->data['siteTitle'] = 'Artykuły mojego bloga';

        $this->data['articles'] = $serviceFactory->getBlogData()->getArticles();

        $view->render($this->data);
    }
}


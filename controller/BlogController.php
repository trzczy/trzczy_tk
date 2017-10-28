<?php
namespace Trzczy\Login\Controller;

class BlogController extends Controller
{
    protected $data;

    function __construct($view, $debugIsOn = false, $serviceFactory = null)
    {
        parent::__construct();

        $debug = new \stdClass;
        $debug->on = $debugIsOn;

        $this->data['debug'] = $debug;
        $this->data['commentLabel'] = 'article';

        $this->data['siteTitle'] = 'Artykuły mojego bloga';

        $this->data['articles'] = $serviceFactory->getBlogData([0])->getArticles();

        $view->render($this->data, 'firstBlog');
    }
}


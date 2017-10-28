<?php
namespace Trzczy\Login\Controller;

class AppsController extends Controller
{
    protected $data;

    function __construct($view, $debugIsOn = false, $serviceFactory = null)
    {
        parent::__construct();

        $debug = new \stdClass;
        $debug->on = $debugIsOn;

        $this->data['debug'] = $debug;

        $this->data['commentLabel'] = 'app';

        $this->data['siteTitle'] = 'Moje aplikacje';

        $this->data['articles'] = $serviceFactory->getBlogData([1])->getArticles();

        $view->render($this->data, 'firstApps');
    }
}


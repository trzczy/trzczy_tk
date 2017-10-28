<?php
namespace Trzczy\Login\Controller;

class AppController extends Controller
{
    protected $data;

    function __construct($view, $debugIsOn = false, $serviceFactory = null, $id)
    {
        parent::__construct();

        $debug = new \stdClass;
        $debug->on = $debugIsOn;

        $this->data['debug'] = $debug;

        $this->data['siteTitle'] = 'Artykuły mojego bloga';

        /** @noinspection PhpUndefinedMethodInspection */
        $this->data['articles'][] = $serviceFactory->getArticleById($id);

        /** @noinspection PhpUndefinedMethodInspection */
        $view->render($this->data, 'firstApp');
    }
}

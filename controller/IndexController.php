<?php
namespace Trzczy\Login\Controller;

class IndexController extends Controller
{
    protected $data;

    function __construct($view, $debugIsOn = false, $serviceFactory = null)
    {
        parent::__construct();

        $debug = new \stdClass;
        $debug->on = $debugIsOn;

        $this->data['debug'] = $debug;
        $this->data['page'] = 'index';

        $this->data['siteTitle'] = 'Moja strona osobista';

        /** @noinspection PhpUndefinedMethodInspection */
        $view->render($this->data, 'firstIndex');
    }
}


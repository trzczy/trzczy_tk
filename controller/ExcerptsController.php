<?php
namespace Trzczy\Login\Controller;

class ExcerptsController extends Controller
{
    protected $data;
    private $prefix = 'Category ';

    function __construct($view, $debugIsOn = false, $serviceFactory = null, $tagName = '')
    {
        parent::__construct();

        $debug = new \stdClass;
        $debug->on = $debugIsOn;

        $this->data['debug'] = $debug;

        $this->data['articles'] = $serviceFactory->getExcerptsByTag($tagName, [0, 1])->getExcerpts();
        $this->data['siteTitle'] = $this->prefix . $tagName;
        $this->data['tagName'] = $tagName;
        $view->render($this->data, 'firstExcerpts');
    }
}


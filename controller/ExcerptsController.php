<?php
namespace Trzczy\Login\Controller;

class ExcerptsController extends Controller
{
    private $data;
    private $prefix = 'Kategoria: ';

    function __construct($view, $debugIsOn = false, $serviceFactory = null, $tagName = '')
    {
        $debug = new \stdClass;
        $debug->on = $debugIsOn;

        $this->data['debug'] = $debug;

        $this->data['articles'] = $serviceFactory->getExcerptsByTag($tagName)->getExcerpts();
        $this->data['siteTitle'] = $this->prefix . $tagName;
        $this->data['tagName'] = $tagName;
        $view->render($this->data, 'excerpts');
    }
}


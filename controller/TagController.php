<?php
namespace Trzczy\Login\Controller;

class TagController extends Controller
{
    private $data;

    function __construct($view, $debugIsOn = false, $serviceFactory = null, $tagName = '')
    {
        $debug = new \stdClass;
        $debug->on = $debugIsOn;

        $this->data['debug'] = $debug;

//        $this->data['excerpts'] = $serviceFactory->getTagData()->getExcerpts();



        $this->data['excerpts'] = $serviceFactory->getExcerptsByTag('tag 2')->getExcerpts();
        $view->render($this->data, 'excerpts');
    }
}


<?php
namespace Trzczy\Login\Controller;

class ContactController extends Controller
{
    protected $data;

    function __construct($view, $debugIsOn = false, $serviceFactory = null)
    {
        parent::__construct();

        $debug = new \stdClass;
        $debug->on = $debugIsOn;

        $this->data['debug'] = $debug;

        $this->data['siteTitle'] = 'Formularz kontaktowy';

        /** @noinspection PhpUndefinedMethodInspection */
        $this->data['referrer'] = $serviceFactory->getReferrer();

        /** @noinspection PhpUndefinedMethodInspection */
        $view->render($this->data, 'firstContact');
    }
}


<?php
namespace Trzczy\Login\Controller;

class ArticleController extends Controller
{
    protected $data;

    function __construct($view, $debugIsOn = false, $serviceFactory = null, $id)
    {
        parent::__construct();



        $debug = new \stdClass;
        $debug->on = $debugIsOn;

        $this->data['debug'] = $debug;

        $this->data['siteTitle'] = 'Artykuły mojego bloga';
        //diep 2017 Oct 25 04:24
        $this->data['ctrl'] = $this->ctrl();
        /** @noinspection PhpUndefinedMethodInspection */
        $this->data['articles'][] = $serviceFactory->getArticleById($id);

        /** @noinspection PhpUndefinedMethodInspection */
        $view->render($this->data, 'firstArticle');
    }
}

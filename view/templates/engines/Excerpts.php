<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class Excerpts extends Engine implements EngineInterface {
    protected $code;
    protected $data;
    protected $parametersArray;
    private $articleIdPrefix = 'article';

    /**
     * @return string
     */
    function getResult() {
        $articlesArray = $this->data["articles"];
        $code = '';
        $ct = 0;
        foreach ($articlesArray as $article) {
            $code .= "{{excerpt/" . $ct++ . "}}";
        }
        return "
        <main class=\"main\">
            {{siteTitle/0}}
            $code
        </main>
";
    }
}



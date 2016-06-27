<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class Head extends Engine implements EngineInterface
{
    protected $data;
    protected $parametersArray;

    /**
     * @return string
     */
    function getResult()
    {
        $pageTitle = ((isset($this->parametersArray[0]))AND('multipleArticles'===($this->parametersArray[0])))
            ?
            $this->data["siteTitle"]
            :
            $this->data['articles'][0]->page_title;
        return "
<head>
    <meta charset=\"utf-8\">
    <title>$pageTitle</title>
    <meta name=\"author\" content=\"Trzczy\">
    <meta name=\"description\"
          content=\"Trzczy is a web and graphic designer. Trzczy loves working with, and speaking about, CSS, HTML, JavaScript, and web standards.\">
    <meta name=\"robots\" content=\"index, follow\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link href='https://fonts.googleapis.com/css?family=Fira+Mono:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Press+Start+2P&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    {{style}}
    {{styleofpygments}}

    <script type=\"text/javascript\" src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js\"></script>
    <script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/gist-embed/2.4/gist-embed.min.js\"></script>

</head>
";
    }
}

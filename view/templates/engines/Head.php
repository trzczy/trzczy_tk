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
        $pageTitle = ((isset($this->parametersArray[0])) AND ('singleArticle' === ($this->parametersArray[0])))
            ?
            $this->data['articles'][0]->page_title
            :
            $this->data["siteTitle"];
        return "
<head>
    <meta charset='utf-8'>
    <title>$pageTitle</title>
    <meta name='description'
          content='Trzczy is a web and graphic designer. Trzczy loves working with, and speaking about, CSS, HTML, JavaScript, and web standards.'>
    <meta name='robots' content='index, follow'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta property='fb:app_id' content='966242223397117'>
    <meta property='fb:admins' content='100004709626907'>
    <meta property='og:url' content='http://trzczy.tk/blog'>
    <meta property='og:title' content='$pageTitle'>
    <meta property='og:description' content='Interesting stuff for creating web sites'>
    <meta property='og:image' content='http://trzczy.tk/trzczy.png'>
    <meta property='og:type' content='article'>
<!--    <meta property='og:site_name' content='$pageTitle'> -->
    

    
    <link href='https://fonts.googleapis.com/css?family=Fira+Mono:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Press+Start+2P&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Inconsolata&amp;subset=latin-ext' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='view/fa/css/font-awesome.min.css'>
    {{style}}
    {{styleofpygments}}
</head>
";
    }
}
<?php
namespace Trzczy\Frameworks\Tpl;

class CodeParser
{
    use GetContent;

    private $routerPattern = "/(?<fields>\b[^\/]+\b)/u";
    private $result;
    private $data;
    private $debug;

    function __construct($result, $patterns, $debug, $data, $view)
    {
        $this->data = $data;
        $this->debug = $debug;
        do {
            preg_match_all($patterns['pattern'], $result, $matches, $patterns['flag'] ? constant($patterns['flag']) : null);
            $matches = $matches['inner'];
            $match = null;
            foreach ($matches as $match) {
                if($match) break;
            }
            if($match) {
                preg_match_all($this->routerPattern, $match, $matchArray);
                $matchArray = array_filter($matchArray["fields"], function ($var) {
                    return ($var || ($var === '0'));
                });
                $label = array_shift($matchArray);
                $html = $this->codeGen($label, $matchArray);

                if (!empty($html)) {
                    $code = $html[0];
                    if ($debug) {
                        if(!preg_match('/{{.+}}/', $code)) $path = $view;
                        $code = $this->addDebugAttributes($html[1], $code);
                    }
                    $result = $this->replaceQueryByText($match, $code, $result);
                }
            }
        } while ($match);
        $this->result = $result;


    }

    /**
     * @param $debugText
     * @param $html
     * @return string
     */
    private function addDebugAttributes($debugText, $html) {
        $dom = new \DOMDocument();
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");
        @$dom->loadHTML($html, LIBXML_HTML_NODEFDTD);
        $x = new \DOMXPath($dom);
        foreach ($x->query("/html/body/*") as $node) {
            $node->setAttribute("title", $debugText);
            $node->setAttribute("data-debug", true);
            $color = sprintf("#%06x",rand(0,16777215));
            $node->setAttribute("style", "background-color: $color;");
        }
        $newHtml = "";
        foreach ($dom->getElementsByTagName('body')->item(0)->childNodes as $child) {
            $newHtml .= html_entity_decode($dom->saveHTML($child));
        }
        return $newHtml;
    }


    function normalizeArray($arrayMatches)
    {
        $matches = [];
        foreach ($arrayMatches as $memberMatches) {
            if (isset($memberMatches['inner'])) {
                $matches[] = $memberMatches['inner'];
            }
        }
        return $matches;
    }

    function normalizeArray2($arrayMatches)
    {
        return array_filter($arrayMatches["inner"]);
    }

    function replaceQueryByText($match, $text, $result)
    {
        return str_replace("{{{$match}}}", $text, $result);
    }

    /**
     * @param $label
     * @param array $matchArray
     * @return string|Style
     */
    function codeGen($label, $matchArray = [])
    {
        $content = $this->getTemplateContent($label);
        $class = ucwords($label);

        $contentAndDebugArray = $this->getEngineContent($class, $content, $label, $matchArray, $this->data, $this->debug);
        if (empty($contentAndDebugArray))
            echo 'Message: ' . "'$class' class is not present in engines folder
                    or '$label' label is not present in templates folder." . '<br><br>';
        return $contentAndDebugArray;
    }

    function getResult()
    {
        return $this->result;
    }

}
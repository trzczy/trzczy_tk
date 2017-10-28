<?php

namespace Trzczy\Frameworks\Tpl;

trait CodeParserHelper
{
    /**
     * @param $label
     * @param array $matchArray
     * @return mixed
     */
    function codeGen($label, $matchArray = [])
    {
        /**
         * @see GetContent
         */

        /** @noinspection PhpUndefinedMethodInspection */
        $content = $this->getTemplateContent($label);
        $class = ucwords($label);
        /**
         * @see GetContent
         */

        /** @noinspection PhpUndefinedMethodInspection */
        $contentAndDebugArray = $this->getEngineContent($class, $content, $label, $matchArray, $this->data,
            $this->debug);
        if (empty($contentAndDebugArray)) {
            echo 'Message: ' . "'$class' class is not present in engines folder
                    or '$label' label is not present in templates folder." . '<br><br>';
        }
        return $contentAndDebugArray;
    }

    /**
     * @param $match
     * @param $text
     * @param $result
     * @return mixed
     */
    function replaceQueryByText($match, $text, $result)
    {
        return str_replace("{{{$match}}}", $text, $result);
    }

    /**
     * @param $html
     * @return string
     */
    private function addDebugAttributes($html)
    {
        $dom = new \DOMDocument();
        $debugText = $html[1];
        $html = mb_convert_encoding($html[0], 'HTML-ENTITIES', "UTF-8");
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();
        $newHtml = "";
        foreach ($dom->getElementsByTagName('body')->item(0)->childNodes as $child) {
            if ($child->nodeType === 1) {
                /** @noinspection PhpUndefinedMethodInspection */
                $child->setAttribute("debug", $debugText);
                /** @noinspection PhpUndefinedMethodInspection */
                $color = sprintf("#%06x", rand(0, 16777215));
                /** @noinspection PhpUndefinedMethodInspection */
                $child->setAttribute("style", "border: dashed $color 7px;");
//                $child->setAttribute("style", "background-color: $color;");
                $newHtml .= html_entity_decode($dom->saveHTML($child));
            }
        }
        return $newHtml;
    }
}
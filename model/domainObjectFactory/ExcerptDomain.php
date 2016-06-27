<?php
namespace Mvc\Model\Domain;

class ExcerptDomain
{
    public $article_id;
    public $title;
    public $created;
    public $username;
    public $body;
    public $tags = [];

    public function __set($key, $value)
    {
        $this->$key = strip_tags($value);
    }

    function __construct(ArticleDomain $object, $serialized)
    {
        $articleDomainVariables = get_object_vars($object);
        foreach ($articleDomainVariables as $property => $value) {
            if (property_exists($this, $property))
                if ($property === 'body')
                    $this->$property = $this->trimToExcerpt($value);
                else
                    $this->$property = $value;
        }
        unset($object);
    }


    function trimToExcerpt($text, $targetLength = 300, $avoidedSuffixPrefixesArr = [' ', ',', '.', ':', ';'], $step = 2)
    {
        $strip = strip_tags($text);
        if (strlen($strip) >= $targetLength) {
            $pattern = '/[' . implode($avoidedSuffixPrefixesArr) . ']/';

            ++$targetLength;
            $n = 0;
            $stripExcerpt = '';

            while (strlen($stripExcerpt) < $targetLength) {
                $cutText = substr($text, 0, $targetLength + (++$n * $step));
                $stripExcerpt = strip_tags($cutText);
            }



            //remove not ended opened tags or closed but w/o content
            $cutText = preg_replace('/(\s*?<(?![^>]*?>\s*\S).*)$/s', '', $cutText, -1, $count);
            //if next char is not a char ending a word trim the last word
            if (!in_array(substr($cutText, -1), $avoidedSuffixPrefixesArr)) {
                $arr = preg_split($pattern, $cutText);
                $cutText = substr($cutText, 0, strlen($cutText) - (strlen(array_pop($arr))));
            }
            //trim last ending chars
            while (in_array(substr($cutText, -1), $avoidedSuffixPrefixesArr)) {
                $cutText = substr($cutText, 0, -1);
            }
            $cutText =$this->htmlRegenerate($cutText);
        } else {
            $cutText = $text;
        }

        
        return htmlspecialchars_decode($cutText);
    }
    function htmlRegenerate($html)
    {
        $dom = new \DOMDocument();
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NODEFDTD);
        $dots = $dom->createTextNode("...");
        $dom->documentElement->lastChild->lastChild->appendChild($dots);
        $innerHTML = "";
        foreach ($dom->getElementsByTagName('body')->item(0)->childNodes as $child) {
            $innerHTML .= $dom->saveHTML($child);
        }
        return $innerHTML;
    }


}

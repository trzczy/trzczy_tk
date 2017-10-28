<?php
namespace Mvc\Model\Domain;

trait ArticleDomainHelper
{

    function copyAnotherObjectFieldsValues($localObject, $remoteObject)
    {
        $remoteObjectVariables = get_object_vars($remoteObject);
        foreach ($remoteObjectVariables as $property => $value) {
            if (property_exists($localObject, $property)) {
                $localObject->$property = $value;
            }
        }
    }

    function cleanArticle($text)
    {
        $text = preg_replace('/[\cK\f\r\x85]+/us', '', $text);
//        $text = preg_replace('/[\v]+/us', '', $text);
        $text = preg_replace('/\h+/us', ' ', $text);
        return $text;
    }

    function replaceBracketsByCompareOperatorsEverywhereButInCodePresentation($betweenCode)
    {
        return preg_replace_callback('/\[(\/?code[ ]?[^\]]*)\]/su', function ($matches) {
            return '<' . $matches[1] . '>';
        },
            $betweenCode
        );
    }
}
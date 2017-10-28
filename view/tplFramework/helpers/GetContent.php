<?php
namespace Trzczy\Frameworks\Tpl;

trait GetContent
{
    function getTemplateContent($label)
    {
        if (file_exists('view/templates/' . $label . '.phtml')) {
            return file_get_contents('view/templates/' . $label . '.phtml');
        }
        return '';
    }

    function getEngineContent($class, $templateContent, $label, $queryArray, $data, $debug = null)
    {
        if (file_exists('view/templates/engines/' . $class . '.php')) {
            $class = 'Trzczy\\Login\\View' . '\\' . $class;
            $obj = new $class($templateContent, $data, $queryArray, $debug);
            /** @noinspection PhpUndefinedMethodInspection */
            return [$obj->getResult(), $obj->getDebugText()];
        }
        return [$templateContent, $label];
    }
}

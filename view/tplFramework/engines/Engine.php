<?php
namespace Trzczy\Frameworks\Tpl;

use DOMDocument;
use DOMXPath;

class Engine
{
    protected $code;
    protected $data;
    protected $parametersArray;
    private $debug;

    public function __construct($code, $data, $parametersArray, $debug)
    {
        $this->code = $code;
        $this->data = $data;
        if (isset($parametersArray) || !empty($parametersArray)) {
            $this->parametersArray = $parametersArray;
        }
        $this->debug = $debug;
    }

    function getDebugText()
    {
        $parametersPart = '';
        foreach ($this->parametersArray as $parameter) {
            $parametersPart .= " -$parameter";
        }
        $classArray = explode('\\', get_class($this));
        $lastMemberIndex = count($classArray) - 1;
        return $classArray[$lastMemberIndex] . $parametersPart;
    }

    function highlight($html) {
        return new Pygments($html);
    }
}
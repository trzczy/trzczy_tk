<?php
namespace Trzczy\Frameworks\Tpl;

class Templates implements ParsePatterns
{
    use GetContent;
    private $result;

    /**
     * Templates constructor.
     * @param $injection
     */
    function __construct($injection, $firstTemplateName)
    {
        $this->result = $this->getTemplateContent($firstTemplateName);
        if($injection['debug']->on)
        {
            $this->result = (new CodeParser($this->result, ParsePatterns::NOBODY, false, $injection, $firstTemplateName))->getResult();
            $this->result = (new CodeParser($this->result, ParsePatterns::BODY, true, $injection, $firstTemplateName))->getResult();
        }else
            $this->result = (new CodeParser($this->result, ParsePatterns::TOTAL, false, $injection, $firstTemplateName))->getResult();
        echo $this->result;
    }
}
// @ 

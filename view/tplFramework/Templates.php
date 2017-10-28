<?php
/**
 * This file contains the main class of the application.
 *
 * @package    Templates
 * @license    https://opensource.org/licenses/MIT
 * @author     Adam Mazurkiewicz <trzczy@gmail.com>
 */
namespace Trzczy\Frameworks\Tpl;
/**
 * An initial class
 *
 * This class that wraps initialization and echoing the template based view. Excludes head html section from
 * inspection mode.
 *
 * @package    Templates
 * @author     Adam Mazurkiewicz <trzczy@gmail.com>
 */
class Templates implements ParsePatterns
{
    use GetContent;
    private $result;

    /**
     * Templates constructor.
     *
     * Gets initial content. Parses the document and does separated parsing for the body when the inspection mode is on.
     * Echos the output.
     * @param $data
     * @param $firstTemplateName
     */
    function __construct($data, $firstTemplateName)
    {
        /**
         * @see GetContent class
         */
        $this->result = $this->getTemplateContent($firstTemplateName);
        if ($data['debug']->on) {
            /**
             * @see CodeParser class
             */
            $this->result = (new CodeParser($this->result, ParsePatterns::NOBODY, false, $data,
                $firstTemplateName))->getResult();
            $this->result = (new CodeParser($this->result, ParsePatterns::BODY, true, $data,
                $firstTemplateName))->getResult();
        } else {
            $this->result = (new CodeParser($this->result, ParsePatterns::TOTAL, false, $data,
                $firstTemplateName))->getResult();
        }
        echo $this->result;
    }
}

<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class SiteTitle extends Engine implements EngineInterface
{
    protected $code;
    protected $data;
    protected $parametersArray;

    /**
     * @return string
     */
    function getResult()
    {
        parse_str($_SERVER['QUERY_STRING'], $o);
        if (array_key_exists('anchor', $o)) {
            unset($o['anchor']);
        }
        $siteTitle = $this->data["siteTitle"];
        return "<h2><a href='?" . http_build_query($o) . "' rel='tag' class = 'site-title" . (($this->parametersArray[0] === 'visuallyHidden') ? ' visually-hidden' : '') . "' tabindex = '-1'>$siteTitle</a></h2>";
    }
}

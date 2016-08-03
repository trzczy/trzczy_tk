<?php
namespace Trzczy\Frameworks\Tpl;
define('MB_WPP_BASE', dirname(__FILE__));

class Pygments
{
    private $text;

    function mb_pygments_convert_code($matches)
    {
        $pygments_build = MB_WPP_BASE . '/index.py';
        $source_code = isset($matches['codeContent']) ? $matches['codeContent'] : '';
        $class_name = isset($matches['lexer']) ? $matches['lexer'] : '';

        // Creates a temporary filename
        $temp_file = tempnam(sys_get_temp_dir(), 'MB_Pygments_');


        // Populate temporary file
        $filehandle = fopen($temp_file, "w");
        fwrite($filehandle, html_entity_decode($source_code, ENT_COMPAT, 'UTF-8'));
        fclose($filehandle);

        // Creates pygments command
        $language = $class_name ? $class_name : 'guess';
        $command = sprintf('python %s %s %s', $pygments_build, $language, $temp_file);

        // Executes the command
        $retVal = -1;
        exec($command, $output, $retVal);
        unlink($temp_file);


        // Returns Source Code
        if ($retVal == 0)
            $highlighted_code = implode("\n", $output);


        return $highlighted_code;
    }

    function getForPygments($dom)
    {
        $codeElements = $dom->getElementsByTagName('code');
        foreach ($codeElements as $codeElement) {
            if ($codeElement->getAttribute('data-pygments')) return $codeElement;
        }
        return;
    }

    function __construct($text)
    {
        $this->text = $text;
    }


    function partsArray($str)
    {
        preg_match_all('/<code\s+lang[^>]*?>/s', $str, $matches);
        $openTag = $matches[0][0];
        $value = str_replace($openTag, '', $str);
        $value = str_replace('</code>', '', $value);
        $finalArr = [];
        $finalArr['codeOpeningTag'] = $openTag;
        $finalArr['codeContent'] = $value;
        return $finalArr;
    }

    function codeElement($arr)
    {
        $str = $arr[0];
        $partsArray = $this->partsArray($str);

        preg_match('/(?<=[\'\"])([^\'\"]*?)(?=[\'\"])/', $partsArray['codeOpeningTag'], $lexerArr);


        $args = array(
            'lexer' => $lexerArr[1],
            'codeContent' => $partsArray['codeContent']
        );

        // convert the code
        $new_code = $this->mb_pygments_convert_code($args);

//hahaha2

//         return htmlspecialchars($str['haha']);
        return $partsArray['codeOpeningTag'] . '<figure class="pygments"><div class="codeWrapper">' . $new_code . '</div></figure></code>';
    }

    function __toString() {

        $result =  (string)preg_replace_callback('/<code[^>]*?>.*?<\/code>/s',
            array($this, "codeElement"),
            $this->text
        );
        return $result;

    }
}

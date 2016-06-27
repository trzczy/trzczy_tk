<?php

define('MB_WPP_BASE', dirname(__FILE__));
function mb_pygments_convert_code($matches)
{
    $pygments_build = MB_WPP_BASE . '/index.py';
    $source_code = isset($matches[3]) ? $matches[3] : '';
    $class_name = isset($matches[2]) ? $matches[2] : '';

    // Creates a temporary filename
    $temp_file = tempnam(sys_get_temp_dir(), 'MB_Pygments_');

    // Populate temporary file
    $filehandle = fopen($temp_file, "w");
    fwrite($filehandle, html_entity_decode($source_code, ENT_COMPAT, 'UTF-8'));
    fclose($filehandle);

    // Creates pygments command
    $language = $class_name ? $class_name : 'guess';
    $command = sprintf('C:\Python27/python %s %s %s', $pygments_build, $language, $temp_file);

    // Executes the command
    $retVal = -1;
    exec($command, $output, $retVal);
    unlink($temp_file);

    // Returns Source Code
    if ($retVal == 0)
        $highlighted_code = implode("\n", $output);
    return $highlighted_code;
}

// This prevent throwing error
libxml_use_internal_errors(true);

// Get all codeElement from post content
$dom = new DOMDocument();
$dom->loadHTML(mb_convert_encoding('
<code title="stas" class="" data-pygments = "php">
$name = "Staś";
echo "Zażółć gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń gęślą jaźń , " . $name . ' . ';
echo "<address>csgo@jo.io</address>";
</code>
<br><br><br><br><p>Coś tam źrę.</p><br><br><br>
<pre><code title="jas" data-pygments="php">
$name = "Jaś";
echo "Zażółć gęślą jaźń, " . $name . \'.\';
echo "<address>hehehe@jo.io</address>";
</code></pre>', 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NODEFDTD);

function getForPygments($dom)
{
    $codeElements = $dom->getElementsByTagName('code');
    foreach ($codeElements as $codeElement) {
        if($codeElement->getAttribute('data-pygments')) return $codeElement;
    }
    return;
}


while ($codeElement = getForPygments($dom)) {
    $args = array(
        2 => $codeElement->getAttribute('data-pygments'),
        3 => $codeElement->nodeValue
    );

    // convert the code
    $new_code = mb_pygments_convert_code($args);

    // Replace the actual codeElement with the new one.
    $new_codeElement = $dom->createDocumentFragment();
    $new_codeElement->appendXML('<figure class="pygments"><div class="codeWrapper">' . $new_code . '</div></figure>');
    $codeElement->parentNode->replaceChild($new_codeElement, $codeElement);
}

// Save the HTML of the new code.
$newHtml = "";
foreach ($dom->getElementsByTagName('body')->item(0)->childNodes as $child) {
    $newHtml .= $dom->saveHTML($child);
}

?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href='https://fonts.googleapis.com/css?family=Fira+Mono:400,700&subset=latin,latin-ext' rel='stylesheet'
          type='text/css'>
    <link rel="stylesheet" href="gh.css">
</head>
<body>
<?= $newHtml ?>
</body>
</html>

<?php
namespace Trzczy\Frameworks\Tpl;

use DOMDocument;

class CodeParser
{
    use CodeParserHelper;
    use GetContent;

    private $routerPattern = "/(?<fields>\b[^\/]+\b)/u";
    private $result;
    private $data;
    private $debug;

    /**
     * CodeParser constructor
     * @param $result
     * @param $pattern
     * @param $debug
     * @param $data
     * @param $view
     */
    function __construct($result, $pattern, $debug, $data, $view)
    {
        $this->data = $data;
        $this->debug = $debug;
        do {
            preg_match_all($pattern['pattern'], $result, $matches, $pattern['flag']
                ?
                constant($pattern['flag'])
                :
                null
            );
            $matches = $matches['inner'];
            $match = null;
            foreach ($matches as $match) {
                if ($match) {
                    break;
                }
            }
            if ($match) {
                preg_match_all($this->routerPattern, $match, $matchArray);
                $matchArray = array_filter($matchArray["fields"], function ($var) {
                    return ($var || ($var === '0'));
                });
                $label = array_shift($matchArray);
                /**
                 * @see CodeParserHelper
                 */
                $html = $this->codeGen($label, $matchArray);
                if (!empty($html)) {
                    $code = $html[0];
                    if ($debug) {

                        /**
                         * @see CodeParserHelper
                         */
                        $code = $this->addDebugAttributes($html);
                    }

                    /**
                     * @see CodeParserHelper
                     */
                    $result = $this->replaceQueryByText($match, $code, $result);
                }
            }
        } while ($match);


        /**
         *
         *
         * @var bool $debug
         */

        /**
         * TitleSnakes
         */


        if ($debug) {
            /**
             * TitleSnakes
             */
            $delimiter = ' ';//todo
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            /** @var string $result */
            $doc->loadHTML($result);//$result todo
            libxml_clear_errors();
            foreach ($doc->getElementsByTagName('*') as $node) {
                /** @noinspection PhpUndefinedMethodInspection */
                if ($node->hasAttribute('title')) {
                    /** @noinspection PhpUndefinedMethodInspection */
                    $node->removeAttribute('title');
                }
            }

            foreach ($doc->getElementsByTagName('*') as $node) {
                /** @noinspection PhpUndefinedMethodInspection */
                if ($node->hasAttribute('debug')) {//'debug' todo
                    $nodeSnake = [$node];
                    while ($node = $node->parentNode) {
                        /** @noinspection PhpUndefinedMethodInspection */
                        if ($node->nodeType === 1 AND $node->hasAttribute('debug')) {
                            $nodeSnake[] = $node;
                        }
                    }
                    for ($i = 0; $i < count($nodeSnake); $i++) {
                        /** @noinspection PhpUndefinedMethodInspection */
                        if (!$nodeSnake[$i]->hasAttribute('title')) {
                            $path = '';
                            for ($j = $i; $j < count($nodeSnake); $j++) {
                                /** @noinspection PhpUndefinedMethodInspection */
                                $path = "{$nodeSnake[$j]->getAttribute('debug')}$delimiter$path";
                            }
                            /** @var string $view */
                            $title = trim("$view $path");//$view todo
                            /** @noinspection PhpUndefinedMethodInspection */
                            $nodeSnake[$i]->setAttribute('title', $title);
                        }
                    }
                }
            }
            $doc->formatOutput = true;
            /** @noinspection PhpUndefinedMethodInspection */
            $result = $doc->saveHTML();
        }
        /**
         *
         *
         */

        $this->result = $result;
    }

    function getResult()
    {
        return $this->result;
    }

}
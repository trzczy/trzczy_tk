<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Engine;
use Trzczy\Frameworks\Tpl\EngineInterface;

class Test extends Engine implements EngineInterface
{
    protected $data;
    protected $parametersArray;

    /**
     * @return string
     */
    function getResult()
    {

$pageIdentifier = 'article' . $this->data['articles'][0]->article_id;



        return "
        <div id='disqus_thread'></div>
<script>
    /*** RECOMMENDED CONFIGURATION VARIABLES ***/
    var disqus_config = function () {
        this.page.url = 'http://trzczy.tk/?anchor&ctrlr=article&id=" . $this->data['articles'][0]->article_id . "';
        this.page.identifier = '$pageIdentifier';
    };

    (function () {
        // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = '//trzczytk.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
    </script>
<noscript>Please enable JavaScript to view the <a href='https://disqus.com/?ref_noscript' rel='nofollow'>comments
        powered by Disqus.</a></noscript>


    ";
    }
}

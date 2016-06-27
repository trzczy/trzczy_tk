<?php

include('disqus.php');

$disqus = new Disqus($disqus_vars['user_api_key']);
$forums = $disqus->get_forum_list($disqus_vars['user_api_key']);
var_dump($disqus);
foreach ($forums as $forum) {
    echo $forum->shortname . " " . $forum->id . "<p>";

}
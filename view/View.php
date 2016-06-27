<?php
namespace Trzczy\Login\View;

use Trzczy\Frameworks\Tpl\Templates;
class View
{
    protected $data;

    public function render($data, $view = 'index') {
        new Templates($data, $view);
    }
}
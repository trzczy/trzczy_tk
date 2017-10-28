<?php
/**
 * Created by PhpStorm.
 * User: mann
 * Date: 25/10/17
 * Time: 03:47
 */

namespace Trzczy\Login\Controller;


class Controller
{
    protected $data;
    protected function ctrl() {
        return strtolower(str_replace('Controller', '', substr(strrchr(get_class($this), "\\"), 1)));
    }
    public function __construct()
    {
        $this->data['ctrl'] = $this->ctrl();
    }
}
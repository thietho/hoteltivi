<?php

namespace Lib;
class Language
{
    private $dir = 'language/';
    public $data;
    public function __construct($code)
    {
        $content = file_get_contents($this->dir.$code.'.json');
        //var_dump($content);
        $this->data = json_decode($content,true);
    }
}
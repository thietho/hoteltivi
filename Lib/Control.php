<?php

namespace Lib;

use Lib\Api;
use Lib\Date;
use Lib\ObjString;

class Control
{
    protected $api;
    protected $string;
    protected $request;
    protected $date;
    protected $data;
    protected $cache;
    protected $setting;
    public function __construct(Api $api)
    {
        global $setting;
        $this->api = $api;
        $this->date = new Date();
        $this->string = new ObjString();
        $this->cache = new Cache();
        $this->request = new Request();
        $this->setting = $setting;
    }

    public function setData($key, $val)
    {
        $this->data[$key] = $val;
    }
    
    public function render($view)
    {
        $filename = CONTROLVIEW . $view;
        if(!empty($this->data)){
            extract($this->data);
        }
        ob_start();
        require($filename);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}
<?php

namespace Lib;

class Control
{
    protected $api;
    protected $string;
    protected $date;
    protected $data;
    protected $cache;
    protected $setting;
    protected $request ;
    protected $labels = array();
    public function __construct(Api $api)
    {
        global $date,$string,$cache,$setting,$request,$labels;
        $this->api = $api;
        $this->date = $date;
        $this->string = $string;
        $this->cache = $cache;
        $this->setting = $setting;
        $this->request  = $request;
        $this->labels = $labels;

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
    public function textMerger($str,$arr){
        foreach($arr as $key => $val){
            $str = str_replace("[$key]",$val,$str);
        }
        return $str;
    }
}
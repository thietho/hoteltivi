<?php

namespace Lib;
class Request
{
    private $dataGet;
    private $dataPost;
    public $method;

    public function __construct()
    {
        if (!empty($_GET)) {
            $this->dataGet = $_GET;
        }
        if(isset($this->dataGet['sitemapid'])){
            $arr = explode('/',$this->dataGet['sitemapid']);
            $this->dataGet['sitemapid'] = $arr[0];
            $this->dataGet['id'] = isset($arr[1])?$arr[1]:'';
        }
        if (!empty($_POST)) {
            $this->dataPost = $_POST;
        }else{
            $this->dataPost = json_decode(file_get_contents('php://input'), true);
        }
        if(!empty($this->dataGet)){
            foreach($this->dataGet as &$val){
                if(!is_array($val)){
                    $val = trim($val);
                }
            }
        }
        if(!empty($this->dataPost)){
            foreach($this->dataPost as &$val){
                if(!is_array($val)){
                    $val = trim($val);
                }

            }
        }
        $this->method = $_SERVER['REQUEST_METHOD'];

    }
    /**
     * @return mixed
     */
    public function get($key)
    {
        if (isset($this->dataGet[$key]))
            return $this->dataGet[$key];
        else {
            return '';
        }
    }
    /**
     * @return mixed
     */
    public function post($key)
    {
        if (isset($this->dataPost[$key]))
            return $this->dataPost[$key];
        else {
            return '';
        }
    }

    /**
     * @return array
     */
    public function getDataPost()
    {
        return $this->dataPost;
    }

    /**
     * @return array
     */
    public function getDataGet()
    {
        return $this->dataGet;
    }

    public function getQueryString()
    {
        return urldecode(http_build_query($this->dataGet));
    }
    public function createLink($sitemapid='',$id=''){

        if($sitemapid == ''){
            return HTTPSERVER;
        }
        if($id == ''){
            if($sitemapid == 'Home'){
                return HTTPSERVER;
            }else{
                return HTTPSERVER."$sitemapid.html";
            }

        }
        return HTTPSERVER."$sitemapid/$id.html";
    }
}
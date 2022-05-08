<?php
namespace Lib;
use Lib\Api;
use Lib\Request;

class Label extends Control
{

    public function __construct(Api $api)
    {
        global $request;
        parent::__construct($api);
        $this->request = $request;
    }

    public function getItem($id){
        $result = $this->api->get('?route=CMS/Label/getLabel&id='.$id);
        if($result['statuscode']){
            return $result['data'];
        }else{
            return array();
        }
    }
    public function getGetList($condition=''){
        $result = $this->api->get('?route=CMS/Label/getLabels'.$condition);
        if($result['statuscode']){
            return $result['data'];
        }else{
            return array();
        }
    }
}
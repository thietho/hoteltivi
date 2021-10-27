<?php
namespace Lib;

class Service extends Control
{
    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
    }

    public function getItem($id){
        $result = $this->api->get('?route=Customize/Service/getService&id='.$id);
        return $result;
    }
    public function getGetList($condition=''){
        $result = $this->api->get('?route=Customize/Service/getServices'.$condition);
        return $result;
    }
    public function save($data){
        $result = $this->api->post('?route=Customize/Service/Save', $data);
        return $result;
    }
}
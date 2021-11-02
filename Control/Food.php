<?php
namespace Lib;

class Food extends Control
{
    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
    }

    public function getItem($id){
        $result = $this->api->get('?route=Customize/Food/getFood&id='.$id);
        return $result;
    }
    public function getGetList($condition=''){
        $result = $this->api->get('?route=Customize/Food/getFoods'.$condition);
        return $result;
    }
    public function save($data){
        $result = $this->api->post('?route=Customize/Food/Save', $data);
        return $result;
    }
}
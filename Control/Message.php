<?php
namespace Lib;

class Message extends Control
{
    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
    }

    public function getItem($id){
        $result = $this->api->get('?route=Core/Message/getMessage&id='.$id);
        return $result;
    }
    public function getGetList($condition=''){
        $result = $this->api->get('?route=Core/Message/getMessages'.$condition);
        return $result;
    }
    public function save($data){
        $result = $this->api->post('?route=Core/Message/Save', $data);
        return $result;
    }
}
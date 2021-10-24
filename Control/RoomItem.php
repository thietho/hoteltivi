<?php
namespace Lib;

class RoomItem extends Control
{

    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
    }

    public function getItem($id){
        $result = $this->api->get('?route=Customize/RoomItem/getRoomItem&id='.$id);
        return $result;
    }
    public function getGetList($condition=''){
        $result = $this->api->get('?route=Customize/RoomItem/getRoomItems'.$condition);
        return $result;
    }
    public function save($data){
        $result = $this->api->post('?route=Customize/RoomItem/Save', $data);
        return $result;
    }

}
<?php
namespace Lib;

class Notification extends Control
{
    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
    }

    public function getItem($id){
        $result = $this->api->get('?route=Core/Notification/getNotification&id='.$id);
        return $result;
    }
    public function getGetList($condition=''){
        $result = $this->api->get('?route=Core/Notification/getNotifications'.$condition);
        return $result;
    }
    public function save($data){
        $result = $this->api->post('?route=Core/Notification/Save', $data);
        return $result;
    }
}
<?php
namespace Lib;
use Lib\Api;
use Lib\Request;

class Contact extends Control
{

    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
    }

    public function getItem($id){
        $result = $this->api->get('?route=CRM/Contact/getContact&id='.$id);
        if($result['statuscode']){
            return $result['data'];
        }else{
            return array();
        }
    }
    public function getGetList($condition=''){
        $result = $this->api->get('?route=CRM/Contact/getContacts'.$condition);
        if($result['statuscode']){
            return $result['data'];
        }else{
            return array();
        }
    }
    public function save($data){
        $result = $this->api->post('?route=CRM/Contact/Save', $data);
        return $result;
    }

}
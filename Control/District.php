<?php
namespace Lib;
use Lib\Api;
use Lib\Request;

class District extends Control
{

    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
    }

    public function getItem($id){
        $result = $this->api->get('?route=Core/District/getDistrict&id='.$id);
        if($result['statuscode']){
            return $result['data'];
        }else{
            return array();
        }
    }
    public function getGetList($condition=''){
        $result = $this->api->get('?route=Core/District/getDistricts'.$condition);
        if($result['statuscode']){
            return $result['data'];
        }else{
            return array();
        }
    }

}
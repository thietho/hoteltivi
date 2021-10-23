<?php
namespace Lib;
use Lib\Api;
use Lib\Request;

class TicketBooking extends Control
{

    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
    }

    public function getItem($id){
        $result = $this->api->get('?route=Customize/TicketBooking/getTicketBooking&id='.$id);
        if($result['statuscode']){
            return $result['data'];
        }else{
            return array();
        }
    }
    public function getGetList($condition=''){
        $result = $this->api->get('?route=Customize/TicketBooking/getTicketBookings'.$condition);
        if($result['statuscode']){
            return $result['data'];
        }else{
            return array();
        }
    }
    public function save($data){
        $result = $this->api->post('?route=Customize/TicketBooking/Save', $data);
        return $result;
    }

}
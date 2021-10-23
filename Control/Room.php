<?php
namespace Lib;
class Room extends Control
{
    public $dataroomview;
    public $arrFacilities;
    public $arrFacilitiesOther;
    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
        $optionset = new OptionSet($this->api);
        $dataroomview = $optionset->getItem(17);
        $this->dataroomview = json_decode($dataroomview['optionsetvalue'],true);
        $dataFacilities= $optionset->getItem(18);
        $this->arrFacilities = json_decode($dataFacilities['optionsetvalue'],true);
        $dataFacilitiesOther= $optionset->getItem(19);
        $this->arrFacilitiesOther = json_decode($dataFacilitiesOther['optionsetvalue'],true);
    }

    public function getItem($id)
    {
        $result = $this->api->get('?route=Customize/Room/getRoom&id=' . $id);
        if ($result['statuscode']) {
            return $result['data'];
        } else {
            return array();
        }
    }
    public function formateData($room){
        $room['viewname'] = $this->dataroomview[$room['view']];
        $facilities = json_decode($room['facilities'],true);
            $arr = array();
            foreach($facilities as $facilitie){
                if(isset($this->arrFacilities[$facilitie])){
                    $arr[] = $this->arrFacilities[$facilitie];
                }
            }
            $room['facilitiesview'] = implode(', ',$arr);

            $facilitiesother = json_decode($room['facilitiesother'],true);
            $arr = array();
            foreach($facilitiesother as $facilitie){
                if(isset($this->arrFacilitiesOther[$facilitie])){
                    $arr[] = $this->arrFacilitiesOther[$facilitie];
                }
            }
            $room['facilitiesotherview'] = implode(', ',$arr);

        return $room;
    }
    public function getGetList($condition = '')
    {
        $result = $this->api->get('?route=Customize/Room/getRooms' . $condition);
        if ($result['statuscode']) {
            return $result['data'];
        } else {
            return array();
        }
    }
    public function checkRoom($roomid, $checkin, $checkout)
    {
        $result = $this->api->post('CheckRoom.api', array(
            'roomid' => $roomid,
            'checkin' => $checkin,
            'checkout' => $checkout,
        ));
        if ($result['statuscode']) {
            return $result['data'];
        } else {
            return array();
        }
    }
    public function getBooking($id)
    {
        $result = $this->api->get('?route=Customize/Booking/getBooking&id=' . $id);
        if ($result['statuscode']) {
            return $result['data'];
        } else {
            return array();
        }
    }
    public function getBookings($condition = '')
    {
        $result = $this->api->get('?route=Customize/Booking/getBookings' . $condition);
        if ($result['statuscode']) {
            return $result['data'];
        } else {
            return array();
        }
    }
    public function saveBooking($data){
        $result = $this->api->post('?route=Customize/Booking/Save', $data);
        return $result;
    }
    public function getBookingDetail($id)
    {
        $result = $this->api->get('?route=Customize/BookingDetail/getBookingDetail&id=' . $id);
        if ($result['statuscode']) {
            return $result['data'];
        } else {
            return array();
        }
    }
    public function getBookingDetails($condition = '')
    {
        $result = $this->api->get('?route=Customize/BookingDetail/getBookingDetails' . $condition);
        if ($result['statuscode']) {
            return $result['data'];
        } else {
            return array();
        }
    }
    public function saveBookingDetail($data){
        $result = $this->api->post('?route=Customize/BookingDetail/Save', $data);
        return $result['data'];
    }
}

<?php
require CONTROL . "RoomItem.php";
class RoomItem extends Page
{
    public function getList(){
        $ctlPrduct = new \Lib\RoomItem($this->api);
        $result = $ctlPrduct->getGetList();
        if($result['statuscode']){
            echo $this->section->loadViewPage('RoomItem/list.tpl',['roomItems'=>$result['data']]);
        }
    }
}
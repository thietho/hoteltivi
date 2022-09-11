<?php
require CONTROL . "RoomItem.php";

class RoomItem extends Page
{
    public function getList()
    {
        $ctlPrduct = new \Lib\RoomItem($this->api);
        $result = $ctlPrduct->getGetList();
        if ($result['statuscode']) {
            echo $this->section->loadViewPage('RoomItem/list.tpl', ['roomItems' => $result['data']]);
        }
    }

    public function getGuestInfo()
    {
        $roomnumber = $this->request->get('roomnumber');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => SMILEENPOIN.'api/IPTV/ListGuestByRoom?Room='.$roomnumber,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $this->response->jsonResult($response);

    }
}
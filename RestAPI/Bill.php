<?php
class Bill extends Page{
    public function getServiceInfo(){
        $roomnumber = $this->request->get('roomnumber');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => DIHOTELENPOIN.'api/RoomInfo/ServiceInfo?Room='.$roomnumber.'&Username=cdr&Password=123',
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
    public function getServiceInfoDate(){
        $roomnumber = $this->request->get('roomnumber');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => DIHOTELENPOIN.'api/RoomInfo/ServiceInfo?Room='.$roomnumber.'&Username=cdr&Password=123',
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
        $data = json_decode($response,true);
        $result = array();
        if($data['Status']=='success'){
            foreach ($data['Data'] as $item){
                $result[$item['Date']][] = $item;
            }
        }
        $this->response->jsonOutput($result);
    }
}
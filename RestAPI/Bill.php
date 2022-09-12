<?php
class Bill extends Page{
    public function getServiceInfo(){
        $folioNum = $this->request->get('folioNum');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => SMILEENPOIN.'api/IPTV/PaymentInfor?FolioNumber='.$folioNum,
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
        $folioNum = $this->request->get('folioNum');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => SMILEENPOIN.'api/IPTV/PaymentInfor?FolioNumber='.$folioNum,
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
        $data = $data[0];
        $result = array();
        if($data['message']=='Success'){
            foreach ($data['data'] as $item){
                $arr = explode(' ',$item['date']);
                $result[$arr[0]][] = $item;
            }
        }
        $this->response->jsonOutput($result);
    }
}
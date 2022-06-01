<?php
namespace Lib;
class Api
{
    private $username;
    private $password;
    private $token;
    private $session;
    private $http;
    private $iscache;
    public $logindata;
    function __construct(){
        $this->username = 'hoteltivi';
        $this->password = 'cntech2022';

        $this->http = CORESYSTEM;
        $this->session = new Session();
        $this->token = $this->session->get('token');
        $this->checkToken();
        $this->checkCacheVersion();

        //var_dump($this->token);
        $this->iscache = true;
//        if(empty($this->token)){
//            echo 'login 1';
//            $this->login();
//        }

    }
    public function checkCacheVersion(){
        $result = $this->post('?route=Core/Auth/getCacheVersion',array());
        $updatetime = $this->session->get('cacheVersion');
        //var_dump($updatetime !== $result['updatetime']);
        if($updatetime !== $result['updatetime']){
            $this->session->set('cacheVersion',$result['updatetime']);
            //echo 'Update Cache';
            $cache = new Cache();
            $cache->clear();
        }
    }
    public function checkToken(){
        if(empty($this->token)){
            $this->login();
        }else{
            $data = array(
                'token' => $this->token,
            );

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->http."?route=Core/Auth/checkToken",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "cache-control: no-cache",
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            $result = json_decode($response,true);
            //print_r($result);
            if($result['statuscode'] == 0 || $result['statuscode'] == -1){
                //echo '111';
                $this->login();
            }
        }

    }
    public function getFile($urlfile,$filename){
        $cache = new Cache();
        $path = $cache->getPath($filename);
        if(empty($path)){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $urlfile,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "cache-control: no-cache",

                ),
            ));
            $response = curl_exec($curl);
            $cache->create($filename,$response);
        }
        return $cache->getPath($filename);
    }
    public function post($url,$data){
        $curl = curl_init();
        //echo $this->http.$url.PHP_EOL;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->http.$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "cache-control: no-cache",
                "Authorization: Bearer ".$this->token,
                'Access-Token: '.$this->token,
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if($httpcode == 401){
            $this->login();
            return $this->post($url,$data);
        }
        $err = curl_error($curl);
        curl_close($curl);

        $result = json_decode($response,true);
        return $result;

    }
    public function postJSON($url,$data){
        $curl = curl_init();
        //echo $this->http.$url.PHP_EOL;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->http.$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "cache-control: no-cache",
                "Content-Type: application/json",
                "Authorization: Bearer ".$this->token,
                'Access-Token: '.$this->token,
            ),
        ));

        $response = curl_exec($curl);
//        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//        if($httpcode == 401){
//            $this->login();
//            return $this->postJSON($url,$data);
//        }
        $err = curl_error($curl);
        curl_close($curl);

        $result = json_decode($response,true);
        return $result;
    }
    public function get($url,$debuger = false){
        $filecache = md5($url).'.json';
        $cache = new Cache();
        $result = $cache->get($filecache);
//        if($url == '?route=CMS/SiteMap/getChilds&parent=82'){
//            echo $this->http.$url.PHP_EOL;
//            echo $filecache.PHP_EOL;
//            var_dump(empty($result));
//            var_dump($result);
//        }
        if(empty($result) || $this->iscache == false || $debuger == true){
            $curl = curl_init();
            //echo $this->http.$url.PHP_EOL;
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->http.$url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "cache-control: no-cache",
                    "Authorization: Bearer ".$this->token,
                    'Access-Token: '.$this->token,
                ),
            ));
            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if($httpcode == 401){
                $this->login();
                return $this->get($url,$debuger);
            }
            $err = curl_error($curl);
            curl_close($curl);
            $cache->create($filecache,$response);
            $result = json_decode($response,true);
            return $result;

        }
        else{
            return json_decode($result,true);
        }

    }
    private function login(){
        $data = array(
            'username' => $this->username,
            'password' => $this->password
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->http."?route=Core/Auth/loginApi",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Type: application/json",
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $this->logindata = json_decode($response,true);
        if($this->logindata['statuscode']){
            $this->token = $this->logindata['token'];
            $this->session->set('token', $this->token);
        }

    }

    public function getImage($w,$h,$path){
        return $this->http."fileserver/images/autosize-".$w."x$h/".$path;
    }

}
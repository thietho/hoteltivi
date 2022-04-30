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
        $this->password = 'sunset@2022';

        $this->http = CORESYSTEM;
        $this->session = new Session();
        $this->token = $this->session->get('token');
        $this->iscache = true;
        if(empty($this->token)){
            $this->login();
        }

    }
    public function checkCacheVersion(){
        $result = $this->post('?route=Core/Auth/getCacheVersion',array());
        $updatetime = $this->session->get('cacheVersion');
        if($updatetime != $result['updatetime']){
            $this->session->set('cacheVersion',$result['updatetime']);
            //echo 'Update Cache';
            $cache = new Cache();
            $cache->clear();
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
//        if(!function_exists('apache_request_headers')){
//            if(substr_count($url,'?')){
//                $url .= "&token=".$this->token;
//            }else{
//                $url .= "?token=".$this->token;
//            }
//
//        }
        if(substr_count($url,'?')){
            $url .= "&token=".$this->token;
        }else{
            $url .= "?token=".$this->token;
        }
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
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if($httpcode == 401){
            $this->login();
            $this->post($url,$data);
        }
        $err = curl_error($curl);
        curl_close($curl);

        $result = json_decode($response,true);
        return $result;
        // if($result == null){
        //     return $this->logindata;
        // }
        // if($result['statuscode'] == 2 || $result['statuscode'] == 0){
        //     $this->login();
        //     $result = $this->post($url,$data);
        //     return $result;
        // }else{
        //     return $result;
        // }

    }
    public function postJSON($url,$data){
        $curl = curl_init();
//        if(!function_exists('apache_request_headers')){
//            $url .= "&token=".$this->token;
//        }
        if(substr_count($url,'?')){
            $url .= "&token=".$this->token;
        }else{
            $url .= "?token=".$this->token;
        }
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
            ),
        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if($httpcode == 401){
            $this->login();
            $this->postJSON($url,$data);
        }
        $err = curl_error($curl);
        curl_close($curl);

        $result = json_decode($response,true);
        return $result;
        // if($result == null){
        //     return $this->logindata;
        // }
        // if($result['statuscode'] == 2 || $result['statuscode'] == 0){
        //     $this->login();
        //     $result = $this->post($url,$data);
        //     return $result;
        // }else{
        //     return $result;
        // }

    }
    public function get($url,$debuger = false){
        $filecache = md5($url).'.json';
        $cache = new Cache();
        $result = $cache->get($filecache);
        if(empty($result) || $this->iscache == false || $debuger == true){
            $curl = curl_init();
            //if(!function_exists('apache_request_headers')){
            $url .= "&token=".$this->token;
            //}
            //echo $url;
            //$this->http.$url.PHP_EOL;
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
                ),
            ));
            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if($httpcode == 401){
                $this->login();
                $this->get($url,$debuger);
            }
            $err = curl_error($curl);
            curl_close($curl);
            $cache->create($filecache,$response);
            $result = json_decode($response,true);
            return $result;
            // if($result == null){
            //     return $this->logindata;
            // }
            // if($result['statuscode'] == 2 || $result['statuscode'] == 0){
            //     $this->login();
            //     $result = $this->get($url);
            // }
            // $cache->create($filecache,json_encode($result));
            // return $result;
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